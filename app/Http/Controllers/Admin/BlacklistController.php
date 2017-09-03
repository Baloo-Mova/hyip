<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\SubscriptionPrice;
use App\Models\User;
use Illuminate\Http\Request;

class BlacklistController extends BaseController
{
    private $_model;
    private $_view = 'blacklist';

    public function __construct(User $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function index()
    {
        return view('Admin::' . $this->_view . '.list', [
            'items' => $this->_model->where('is_banned', true)->paginate(15),
        ]);
    }

    public function postEdit(Request $request, $user_id)
    {
        if( empty($user_id) || !is_numeric($user_id) || !($user = $this->_model->find($user_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }
        if (!$request->get('banned')) {
            $user->update([
                'is_banned' => 0,
            ]);
        }

        return redirect()->route('admin.blacklist');
    }
}