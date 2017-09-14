<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\SubscriptionPrice;
use App\Models\User;
use App\Models\UserConfirm;
use Illuminate\Http\Request;

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

        return view('Admin::' . $this->_view . '.list', [
            'users' => $this->_model->paginate(25),
        ]);
    }

    public function search(Request $request)
    {
        $where = [];
        $search = [];
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
        $users = User::where($where)->paginate(25);

        return view('Admin::' . $this->_view . '.list', [
            'search' => $search,
            'users' => $users,
        ]);
    }

    public function remove($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return back();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('Admin::' . $this->_view . '.edit', [
            'user' => $user,
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


        \Session::flash('messages', ['Edit Successful']);
        return back();
    }

    public function ban(Request $request, $id, $type)
    {
        $user = User::findOrFail($id);

        $user->is_banned = $type;
        $user->save();

        return redirect(route('admin-users-list'));

    }

    public function confirm($id)
    {
        $user = User::find($id);
        $data = $user->passportData;
        $scans = $user->scans;
        return view('Admin::' . $this->_view . '.confirm', [
            'data' => $data,
            'scans' => $scans
        ]);
    }

    public function confirmSave(Request $request)
    {
        $user_id = $request->get('user_id');
        $is_confirm = $request->get('is_confirm');

        if($is_confirm == 1){
            $user = User::find($user_id);
            $user->is_confirm = 1;
            $user->save();
        }

        $conf = UserConfirm::where(['user_id' => $user_id, 'is_read' => 0])->first();
        $conf->is_read = 1;
        $conf->save();

        return redirect(route('admin-users-list'));

    }


}