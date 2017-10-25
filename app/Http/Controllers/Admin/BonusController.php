<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bonus;
use App\Models\Subscription;
use App\Models\SubscriptionsLog;
use App\Models\WalletProcesses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BonusController extends Controller
{
    public function index()
    {
        $list = WalletProcesses::bonuses()->paginate(15);
        return view('Admin::bonus.index', ['list' => $list]);
    }

    public function create()
    {
        $rates = Subscription::where(['is_active' => 1])->get();
        return view('Admin::bonus.edit', ['rates' => isset($rates) ? $rates : []]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'bonus_type' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.bonus.create'))
                ->withErrors($validator);
        }

        $amount = $request->get('amount');
        $comment = $request->get('comment');
        $bonus_type = $request->get('bonus_type');

        switch ($bonus_type){
            case 1:
                $users = $this->allUsers($request->has('all_users'), $request, $amount);
                break;
            case 2:
                $users = $this->usersToTariff($request->get('tariff'), $request->get('period'), $amount);
                break;
        }

        if(!isset($users)){
            return redirect(route('admin.bonus.create'))
                ->withErrors("Пользователей, подходящих под эти критерии не найдено!");
        }

        $withdraw = [];

        foreach ($users as $user){
            $dt = Carbon::now();
            $withdraw[] = [
                'type_id' => WalletProcesses::BONUS,
                'time' => $dt,
                'value' => $amount,
                'from_id' => 1,
                'comment' => isset($comment) ? $comment : null,
                'status' => WalletProcesses::STATUS_ACCEPT,
                'to_id' => $user->id,
                'created_at' => $dt,
                'updated_at' => $dt
            ];
        }

        DB::table('wallet_processes')->insert($withdraw);

        Session::flash("messages", ["Бонус успешно начислен"]);
        return redirect()->route('admin.bonus.index');
    }

    protected function usersToPeriod($period, $amount)
    {
        $find = stripos($period, ' -');
        $date_from = \Carbon\Carbon::parse(substr($period, 0, $find))->toDateTimeString();
        $date_to = \Carbon\Carbon::parse(substr($period, $find + 3))->toDateTimeString();
        User::whereBetween('created_at', [$date_from, $date_to])->update(['balance' => DB::raw('balance +'.$amount)]);
        return User::whereBetween('created_at', [$date_from, $date_to])->get();
    }

    protected function usersToTariff($tariff, $period, $amount)
    {
        $find = stripos($period, ' -');
        $date_from = \Carbon\Carbon::parse(substr($period, 0, $find))->toDateTimeString();
        $date_to = \Carbon\Carbon::parse(substr($period, $find + 3))->toDateTimeString();
        $ids = SubscriptionsLog::whereIn('subscribe_id', $tariff)->whereBetween('created_at', [$date_from, $date_to])->distinct('user_id')->get(['user_id'])->toArray();

        User::whereIn('id', array_column($ids, 'user_id'))->update(['balance' => DB::raw('balance +'.$amount)]);
        return User::whereIn('id', array_column($ids, 'user_id'))->get();
    }

    protected function allUsers($type, $request, $amount)
    {
        if($type){
            DB::table('users')->update(['balance' => DB::raw('balance +'.$amount)]);
            return User::all();
        }else{
            User::whereIn('id', $request->get('user'))->update(['balance' => DB::raw('balance +'.$amount)]);
            return User::whereIn('id', $request->get('user'))->get();
        }
    }

    public function getUser(Request $request)
    {
        $users = User::select(['id', 'login', 'email'])
            ->where('login', 'like', '%' . $request->email['term'] . '%')
            ->orWhere('email', 'like', '%' . $request->email['term'] . '%')
            ->offset($request->page == null ? 0 : $request->page * 10)
            ->limit(10)
            ->get();
        $response = [];
        foreach ($users as $item) {
            $response[] = [
                'id' => $item->id,
                'text' => $item->login . " " . $item->email
            ];
        }

        return response()->json($response);
    }

}
