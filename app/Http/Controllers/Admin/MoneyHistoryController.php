<?php

namespace App\Http\Controllers\Admin;

use App\Models\WalletProcesses;
use App\Models\WalletProcessesType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoneyHistoryController extends Controller
{
    public function index()
    {
        $history = WalletProcesses::orderBy('time', 'desc')->paginate(15);
        $pay_systems = config("payment.pay_systems");
        $types = WalletProcessesType::all();
        return view('Admin::money-history.index', [
            'history' => $history,
            'pay_systems' => $pay_systems,
            'types' => $types
        ]);
    }

    public function find(Request $request)
    {

        $where = [];
        $search = [];
        $pay_systems = config("payment.pay_systems");
        $types = WalletProcessesType::all();

        if($request->has('type_id')){
            $where[] = ['type_id', '=', $request->get('type_id')];
            $search['type_id'] = $request->get('type_id');
        }

        if($request->has('pay_system')){
            $where[] = ['pay_system', '=', $request->get('pay_system')];
            $search['pay_system'] = $request->get('pay_system');
        }

        if($request->has('card_number')){
            $where[] = ['card_number', 'like', '%'.$request->get('card_number').'%'];
            $search['card_number'] = $request->get('card_number');
        }

        if($request->has('to_id')){
            $where[] = ['to_id', '=', $request->get('to_id')];
            $search['to_id'] = $request->get('to_id');
        }

        $daterange = $request->get('time');
        if (isset($daterange)) {
            $find = stripos($daterange, ' -');
            $date_from = \Carbon\Carbon::parse(substr($daterange, 0, $find))->toDateTimeString();
            $date_to = \Carbon\Carbon::parse(substr($daterange, $find + 3))->toDateTimeString();

            $history = WalletProcesses::where($where)->whereBetween('time', [$date_from, $date_to])->paginate(15);

        }else{
            $history = WalletProcesses::where($where)->paginate(15);
        }

        return view("Admin::money-history.index", [
            'history' => $history,
            'pay_systems' => $pay_systems,
            'search' => $search,
            'types' => $types
        ]);

    }
}
