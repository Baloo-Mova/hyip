<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WalletProcesses;
use App\Helpers\CPayeer;

class WithdrawController extends Controller
{
    public function index($status)
    {
        $withdraws = WalletProcesses::getWithdraws($status);
        return view('Admin::withdraw.list', [
            'withdraws' => $withdraws,
            'status' => $status
        ]);
    }

    public function edit($id)
    {
        $withdraw = WalletProcesses::find($id);
        if(!isset($withdraw)){
            return redirect()->route('admin.withdraws', ['status' => 3])->withErrors(['Записи с таким ID не найдено!']);
        }

        return view('Admin::withdraw.edit', [
            'withdraw' =>$withdraw,
        ]);
    }

    public function save(Request $request)
    {
        $comment = $request->has('comment') ? $request->get('comment') : "";
        $wid = $request->get('wid');

        $withdraw = WalletProcesses::find($wid);
        if(!isset($withdraw)){
            return redirect()->route('admin.withdraws', ['status' => 3])->withErrors(['Записи с таким ID не найдено!']);
        }
        if($withdraw->status != 0){
            return redirect()->route('admin.withdraws', ['status' => 3])->withErrors(['Эта заявка уже обработана!']);
        }
        if($request->has('decline')){
            return $this->decline($wid, $comment, $withdraw, ['Отказ выполнен успешно!']);
        }


        $payeer = new CPayeer(config('payment.payeer_numer'), config('payment.payeer_api_id'), config('payment.payeer_api_key'));
        if ($payeer->isAuth())
        {
            $balance = $payeer->getBalance()['balance'];
        }
        else
        {
            return $this->decline($wid, 'Ошибка настроек системы! Обратитесь к поддержке!', $withdraw, ['Ошибка подключения к Payeer. Заявка не выполнена!']);
        }

        if($balance['RUB']['DOSTUPNO'] < $withdraw->sum){
            return $this->decline($wid, 'Ошибка настроек системы! Обратитесь к поддержке!', $withdraw, ['На кошельке Payeer Недостаточно средств. Заявка не выполнена!']);
        }

        $pay_system = config('payment.pay_systems')[$withdraw->pay_system];

        $withdraw_value = $withdraw->value;

        if($pay_system['gate_commission'] != 0){
            $withdraw_value += $withdraw->value * $pay_system['gate_commission'] / 100;
        }

        if($pay_system['commission_site_percent'] != 0){
            $withdraw_value += $withdraw->value * $pay_system['commission_site_percent'] / 100;
        }

        if(count($pay_system['r_fields']) > 1){
            $initOutput = $payeer->initOutput(array(
                'ps' => $withdraw->pay_system,
                'curIn' => 'RUB',
                'sumOut' => $withdraw->pay_system  == '1136053' ? $withdraw_value : $withdraw->value,
                'curOut' => 'RUB',
                'param_ACCOUNT_NUMBER' => $withdraw->card_number,
                'param_CONTACT_PERSON' => $withdraw->contact_person
            ));
        }else{
            $initOutput = $payeer->initOutput(array(
                'ps' => $withdraw->pay_system,
                'curIn' => 'RUB',
                'sumOut' => $withdraw->pay_system  == '1136053' ? $withdraw_value : $withdraw->value,
                'curOut' => 'RUB',
                'param_ACCOUNT_NUMBER' => $withdraw->card_number
            ));
        }

        if ($initOutput)
        {
            $historyId = $payeer->output();
            if ($historyId > 0)
            {
                $withdraw->status = 1;
                $withdraw->save();

                return redirect()->route('admin.withdraws', ['status' => 3])->with('messages', ['Оплата успешно произведена!']);
            }
            else
            {
                return $this->decline($wid, 'Выплата не прошла, попробуйте еще раз!', $withdraw, ['Ошибка выплаты! Заявка не выполнена!']);
            }
        }
        else
        {
            return $this->decline($wid, 'Ошибка настроек системы! Обратитесь к поддержке!', $withdraw, ['Ошибка выплаты! Заявка не выполнена!']);
        }

    }

    protected function decline($wid, $comment, $withdraw, $message)
    {
        $withdraw->status = 2;
        $withdraw->comment = $comment;
        $withdraw->save();

        $user = User::find($withdraw->from_id);
        $user->balance = $user->balance + $withdraw->value;
        $user->save();

        return redirect()->route('admin.withdraws', ['status' => 3])->with('messages', $message);
    }
}
