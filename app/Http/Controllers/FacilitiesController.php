<?php

namespace App\Http\Controllers;

use App\Http\Requests\Facilities\RefillRequest;
use App\Models\PaymentsRequest;
use App\Models\User;
use App\Models\WalletProcesses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\SocialNetwork;
use App\Models\InputOutput;

class FacilitiesController extends Controller
{
    public function index($type)
    {
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $item = InputOutput::where(['id' => 1, 'need_show' => 1])->first();
        $operations = WalletProcesses::with('getType')->where(['from_id' => \Auth::user()->id])->orderBy('time', 'desc')->paginate(15);
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('cabinet.facilities.index', [
            'data' => $data,
            'type' => $type,
            'item' => $item,
            'operations' => $operations
        ]);
    }

    public function operations()
    {
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('cabinet.facilities.operations', [
            'data' => $data
        ]);
    }

    public function refill(RefillRequest $request)
    {
        $user_id = \Auth::id();

        $payment = PaymentsRequest::create([
            'user_id' => $user_id,
            'summ' => $request->get('count'),
            'status' => 0,
            'comment' => 'refill',
        ]);

        $payment_config = config('payment');

        $m_shop = $payment_config['m_shop'];
        $m_orderid = $payment->id;
        $m_amount = number_format($request->get('count'), 2, '.', '');
        $m_curr = $payment_config['m_curr'];
        $m_desc = base64_encode('Пополнение баланса');
        $m_key = $payment_config['m_key'];

        $arHash = [
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc,
            $m_key,
        ];

        $sign = strtoupper(hash('sha256', implode(':', $arHash)));

        return redirect("https://payeer.com/merchant/?m_shop=$m_shop&m_orderid=$m_orderid&m_amount=$m_amount&m_curr=$m_curr&m_desc=$m_desc&m_sign=$sign");
    }

    public function statusResult(Request $request)
    {

        if (!in_array($_SERVER['REMOTE_ADDR'], ['185.71.65.92', '185.71.65.189', '149.202.17.210'])) return;

        if (isset($_POST['m_operation_id']) && isset($_POST['m_sign'])) {
            $m_key = config('payment.m_key');
            $arHash = array(
                $_POST['m_operation_id'],
                $_POST['m_operation_ps'],
                $_POST['m_operation_date'],
                $_POST['m_operation_pay_date'],
                $_POST['m_shop'],
                $_POST['m_orderid'],
                $_POST['m_amount'],
                $_POST['m_curr'],
                $_POST['m_desc'],
                $_POST['m_status']
            );

            $arHash[] = $m_key;
            $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));

            if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success') {
                $payment = PaymentsRequest::find($_POST['m_orderid']);

                if (!isset($payment) || $payment->status == 1) {
                    exit($_POST['m_orderid'] . '|error');
                }

                $payment->update([
                    'status' => 1
                ]);

                $user = User::find($payment->user_id);
                $user->balance += $_POST['m_amount'];
                $user->save();

                exit($_POST['m_orderid'] . '|success');
            }
            exit($_POST['m_orderid'] . '|error');
        }
    }

    public function getResultRefill(Request $request, $type)
    {
        if ($type == "success") {
            Session::flash('messages', ['Оплата успешна, средства зачислены на баланс.']);
            return redirect()->route('facilities');
        }
        return redirect()->route('facilities')->withErrors('Ошибка оплаты');
    }
}
