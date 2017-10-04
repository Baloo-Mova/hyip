<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\Subscription;
use App\Models\User;
use App\Models\WalletProcesses;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $users['all_users'] = User::count();
        $users['banned'] = User::banned()->count();
        $settings = Settings::find(1);
        $dt = Carbon::now()->subDays(3);
        $users['active'] = User::whereNotNull('subscribe_id')->count();


        $withdraws['paid_out'] = WalletProcesses::where(['type_id' => WalletProcesses::OUTPUT, 'status' => WalletProcesses::STATUS_ACCEPT])->sum('value');
        $withdraws['all'] = WalletProcesses::whereIn('type_id', [WalletProcesses::REFERRALS, WalletProcesses::BONUS])->sum('value') - $withdraws['paid_out'];
        $withdraws['expects'] = WalletProcesses::where(['type_id' => WalletProcesses::OUTPUT, 'status' => WalletProcesses::STATUS_UNREAD])->sum('value');
        $withdraws['earned'] = $settings->received;


        $subscriptions = Subscription::orderBy('is_active', 'desc')->get()->groupBy('is_active');

        return view('Admin::dashboard.index', [
            'users' => $users,
            'subscriptions' => $subscriptions,
            'withdraws' => $withdraws
        ]);
    }
}