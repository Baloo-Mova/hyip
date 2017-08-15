<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends BaseController
{
    private $_model;
    private $_view = 'subscription';

    public function __construct(Subscription $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function postEdit(Request $request, $subscription_id = null )
    {
        $validator = \Validator::make($request->all(), with(new CreateSubscriptionRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        if( empty($subscription_id) || !is_numeric($subscription_id) || !($subscription = $this->_model->find($subscription_id)) ) {
            $subscription = $this->_model;
        }

        $subscription->fill([
            'name'          => $request->get('name'),
            'price'         => $request->get('price'),
            'term'          => $request->get('term'),
            'description'   => $request->get('description'),
            'is_active'     => $request->get('is_active') ? $request->get('is_active') : 0,
            'levels'        => $request->get('levels'),
        ]);
        dd($subscription);

        $subscription->save();

        return redirect()->route('admin-get-subscription', ['id' => $subscription->id])->with('messages', ['Created successful']);
    }
}