<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\SubscriptionPrice;
use App\Models\User;
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


}