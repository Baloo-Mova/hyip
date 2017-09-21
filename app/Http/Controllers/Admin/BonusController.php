<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bonus;
use App\Models\WalletProcesses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BonusController extends Controller
{
    public function index()
    {
        $list = WalletProcesses::bonuses()->paginate(15);
        return view('Admin::bonus.index', ['list' => $list]);
    }

    public function create()
    {
        return view('Admin::bonus.edit');
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.bonus.create'))
                ->withErrors($validator);
        }

        $user_id = $request->get('user');
        $amount = $request->get('amount');
        $comment = $request->get('comment');

        $user = User::find($user_id);

        if(!isset($user)){
            return redirect(route('admin.bonus.create'))
                ->withErrors("Такого пользователя не существует!");
        }

        $user->balance = $user->balance + $amount;
        $user->save();

        $log = new WalletProcesses();
        $log->type_id = WalletProcesses::BONUS;
        $log->time = Carbon::now();
        $log->value = $amount;
        $log->from_id = 1;
        $log->comment = isset($comment) ? $comment : null;
        $log->status = WalletProcesses::STATUS_ACCEPT;
        $log->to_id = $user_id;
        $log->save();

        Session::flash("messages", ["Бонус успешно начислен"]);
        return redirect()->route('admin.bonus.index');
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
