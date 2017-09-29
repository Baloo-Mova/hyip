<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\WalletProcesses;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $users['all_users'] = User::count();
        $users['banned']    = User::banned()->count();

        $dt = Carbon::now()->subDays(3);
        $users['active']    = User::whereNotNull('subscribe_id')->count();

        $withdraws['all'] = WalletProcesses::where(['status' => 1])->sum('value');
        $withdraws['paid_out'] = WalletProcesses::where(['type_id' => 3, 'status' => 1])->sum('value');
        $withdraws['expects'] = WalletProcesses::where(['type_id' => 3, 'status' => 0])->sum('value');


        $subscriptions      = Subscription::orderBy('is_active', 'desc')->get()->groupBy('is_active');

        return view('Admin::dashboard.index', [
            'users'         => $users,
            'subscriptions' => $subscriptions,
            'withdraws' => $withdraws
        ]);
    }
}