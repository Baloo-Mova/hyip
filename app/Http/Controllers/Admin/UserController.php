<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\SubscriptionPrice;
use App\Models\User;
use App\Models\UserConfirm;
use App\Models\UsersPageSettings;
use Illuminate\Http\Request;
use App\Models\Referrals;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\PassportData;
use Carbon\Carbon;
use App\Models\WalletProcesses;

class UserController extends BaseController
{
    private $_model;
    private $_view = 'users';

    public function __construct(User $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function index()
    {
        $levels = UsersPageSettings::orderBy('value', 'asc')->get();

        $table1 = [];

        foreach ($levels as $level){
            $count = User::where([
                ['ref_count', '>', '0'],
                ['ref_count', '>=', $level->value],
                    ])->count();
            $table1[] = [
                'level' => $level->value,
                'value' => $count
            ];
        }

        $maxLevel = DB::table('referrals')->max('level');

        $table2 = [];

        if(isset($maxLevel) && $maxLevel > 0){
            foreach (range(1, $maxLevel) as $item){
                $count = Referrals::where(['level' => $item])->distinct('user_id')->count('user_id');
                $table2[] = [
                    'level' => $item,
                    'value' => $count
                ];
            }
        }

        $users = User::orderBy('confirmed_date', 'desc')->paginate(15);

        return view('Admin::' . $this->_view . '.index',[
            'table1' => $table1,
            'table2' => $table2,
            'users' => $users
        ]);
    }

    public function userInfo($user_id, $type, $val)
    {
        $user = User::find($user_id);
        $passportData = PassportData::where('user_id', '=', $user_id)->first();
        $scans = $user->scans;
        $count = Referrals::where(['user_id' => $user_id])->count();
        $active = Carbon::now()->subDays(3) < $user->last_activity ? 1 : 0;
        $ref = Referrals::select(DB::raw('level, count(id) as count, sum(earned) as sum'))
            ->where(['user_id' => $user_id])
            ->groupBy('level')
            ->get();
        $reftmp = Referrals::where(['user_ref' => $user_id])->first();
        $refjoin = Referrals::where(['user_id' => $user_id])->paginate(15);
        if(!isset($reftmp)){
            $refName = "";
        }else{
            $refName = isset($reftmp->user_from_name) ? $reftmp->user_from_name : User::where(['id' => $reftmp->user_id])->select('login')->first()->login;
            if(!isset($refName)){
                $refName = "";
            }
        }
        $sum_all = 0;
        if(!isset($ref)){
            $sum_all = 0;
        }else{
            foreach ($ref as $r){
                $sum_all += $r->sum;
            }
        }
        $paid_out = WalletProcesses::where(['type_id' => 3, 'status' => 1, 'to_id' => $user_id])->sum('value');
        return view('Admin::' . $this->_view . '.info',[
            'user' => $user,
            'passport_data' => isset($passportData) ? json_decode($passportData->passport_data) : null,
            'active' => $active,
            'scans' => $scans,
            'paid_out' => $paid_out,
            'ref' => $ref,
            'sum_all' => $sum_all,
            'count' => $count,
            'ref_name' => $refName,
            'refjoin' => $refjoin,
            'type' => $type,
            'val' => $val
        ]);
    }

    public function userList($type, $val)
    {
        if($type == 1){ //number
            $users = User::where([
                ['ref_count', '>', '0'],
                ['ref_count', '>=', $val],
            ])->paginate(15);
        }else{ //value
            $ref = Referrals::select(DB::raw('user_id'))
                ->where(['level' => $val])
                ->distinct('user_id')
                ->get()
                ->toArray();
            $users = User::whereIn('id', array_column($ref, 'user_id'))->orderBy('confirmed_date', 'desc')->paginate(15);
        }

        return view('Admin::' . $this->_view . '.list', [
            'users' => $users,
            'type' => $type,
            'val' => $val
        ]);
    }

    public function search(Request $request)
    {
        $where = [];
        $search = [];
        $type = $request->get('type');
        $val = $request->get('val');
        if($request->has('id')){
            $where[] = ['id', '=', $request->get('id')];
            $search['id'] = $request->get('id');
        }
        if($request->has('email')){
            $where[] = ['email', 'like', '%'.$request->get('email').'%'];
            $search['email'] = $request->get('email');
        }
        if($request->has('login')){
            $where[] = ['login', 'like', '%'.$request->get('login').'%'];
            $search['login'] = $request->get('login');
        }
        if($request->has('ref_name')){
            $where[] = ['ref_name', 'like', '%'.$request->get('ref_name').'%'];
            $search['ref_name'] = $request->get('ref_name');
        }
        if($request->has('is_confirm')){
            $isConfirm = $request->get('is_confirm');
            if($isConfirm == 1){
                $where[] = ['is_confirm', '=', 1];
            }
            if($isConfirm == 0){
                $where[] = ['is_confirm', '=', 0];
            }
            $search['is_confirm'] = $isConfirm;
        }
        if($request->has('is_active')) {
            $isActive = $request->get('is_active');
            $search['is_active'] = $isActive;
        }else{
            $isActive = null;
        }

        switch ($type){
            case 1:
                $where[] = ['ref_count', '>', '0'];
                $where[] = ['ref_count', '>=', $val];
                $users = $this->findUsers($where, $isActive, null);
                break;
            case 2:
                $ref = Referrals::select(DB::raw('user_id'))
                    ->where(['level' => $val])
                    ->distinct('user_id')
                    ->get()
                    ->toArray();
                $users = $this->findUsers($where, $isActive, $ref);
                break;
            case 'all':
                $users = $this->findUsers($where, $isActive, null);
                break;
        }

        return view('Admin::' . $this->_view . '.list', [
            'search' => $search,
            'users' => $users,
            'type' => $type,
            'val' => $val
        ]);
    }

    protected function findUsers($where, $isActive, $ref)
    {
        if(isset($ref)){
            if(isset($isActive)){
                switch ($isActive){
                    case 0:
                        return User::whereIn('id', array_column($ref, 'user_id'))->where($where)->whereNull('subscribe_id')->orderBy('confirmed_date', 'desc')->paginate(15);
                        break;
                    case 1:
                        return User::whereIn('id', array_column($ref, 'user_id'))->where($where)->whereNotNull('subscribe_id')->orderBy('confirmed_date', 'desc')->paginate(15);
                        break;
                    case 2:
                        return User::whereIn('id', array_column($ref, 'user_id'))->where($where)->orderBy('confirmed_date', 'desc')->paginate(15);
                        break;
                }
            }else{
                return User::whereIn('id', array_column($ref, 'user_id'))->where($where)->orderBy('confirmed_date', 'desc')->paginate(15);
            }
        }else{
            if(isset($isActive)){
                switch ($isActive){
                    case 0:
                        return User::where($where)->whereNull('subscribe_id')->orderBy('confirmed_date', 'desc')->paginate(15);
                        break;
                    case 1:
                        return User::where($where)->whereNotNull('subscribe_id')->orderBy('confirmed_date', 'desc')->paginate(15);
                        break;
                    case 2:
                        return User::where($where)->orderBy('confirmed_date', 'desc')->paginate(15);
                        break;
                }
            }else{
                return User::where($where)->orderBy('confirmed_date', 'desc')->paginate(15);
            }
        }
    }

    public function remove($id)
    {
        $refs = Referrals::where('user_ref', $id)->get();
        $refsArr = [];
        $usersId = [];
        foreach ($refs as $ref){
            $usersId[] = $ref->user_id;
            $refsArr[] = $ref->id;
        }

        Referrals::where('user_id', $id)->delete();
        Referrals::whereIn('id', $refsArr)->delete();
        User::where('referral_id', $id)->update([
            'referral_id' => null,
            'ref_name' => null
        ]);
        User::whereIn('id', $usersId)->decrement('ref_count');

        $user = User::findOrFail($id);

        $user->delete();

        Session::flash('messages', ['Пользователь успешно удален!']);
        return back();
    }

    public function userEdit($id, $type, $val)
    {

        $user = User::findOrFail($id);

        return view('Admin::' . $this->_view . '.edit', [
            'user' => $user,
            'val' => $val,
            'type' => $type,
            'banState' => [
                [
                    'id' => 0,
                    'name' => 'No'
                ],
                [
                    'id' => 1,
                    'name' => 'Yes'
                ]
            ],
            'roles' => [
                [
                    'id' => 1,
                    'name' => "User",
                ],
                [
                    'id' => 2,
                    'name' => "Admin"
                ]
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->fill($request->all());
        $user->save();

        Session::flash('messages', ['Пользователь успешно отредактирован!']);
        return back();
    }

    public function ban(Request $request, $id, $type, $list_type, $val)
    {
        $user = User::findOrFail($id);

        $user->is_banned = $type;
        $user->save();

        if($list_type == 'all'){
            return redirect(route('admin.users.index'));
        }

        return redirect(route('admin-users-list', [
            'type' => $list_type,
            'val' => $val
        ]));

    }

    public function confirm($id, $type, $val)
    {
        $user = User::find($id);
        $data = $user->passportData;
        $scans = $user->scans;


        return view('Admin::' . $this->_view . '.confirm', [
            'data' => $data,
            'scans' => $scans,
            'type' => $type,
            'val' => $val
        ]);
    }

    public function confirmSave(Request $request)
    {
        $user_id = $request->get('user_id');
        $is_confirm = $request->get('is_confirm');

        $type = $request->get('type');
        $val = $request->get('val');

        if($is_confirm == 1){
            $user = User::find($user_id);
            $user->is_confirm = 1;
            $user->confirmed_date = null;
            $user->save();
            Session::flash('messages', ['Вы подтвердили данные пользователя!']);
        }else{
            $user = User::find($user_id);
            $user->is_confirm = 0;
            $user->confirmed_date = null;
            $user->save();
            Session::flash('messages', ['Вы не подтвердили данные пользователя!']);
        }

        UserConfirm::where(['user_id' => $user_id])->delete();

        if($type == 'all'){
            return redirect(route('admin.users.index'));
        }


        return redirect(route('admin-users-list', [
            'type' => $type,
            'val' => $val
        ]));

    }


}