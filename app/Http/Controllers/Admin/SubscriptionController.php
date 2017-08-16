<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\SubscriptionPrice;
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

    public function getEdit($item_id = null)
    {
        if( empty($item_id) || !is_numeric($item_id) || !($item = $this->_model->where('id', $item_id)->with('prices')->first()) ) {
            $item = $this->_model;
        }
//        dd($item);

        return view('Admin::subscription.edit', [
            'item' => $item
        ]);
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

        $subscription->save();

        $subscription->prices()->delete();
        $prices = [];

        if( $request->get('level') && is_array($request->get('level')) && count($request->get('level')) > 0 ) {
            foreach ($request->get('level') as $key => $item) {
                $prices[] = [
                    'subscription_id'   => $subscription->id,
                    'value'             => $item['count'],
                    'is_percent'        => isset($item['is_percent']) ? !!$item['is_percent'] : false,
                    'level'             => $key,
                ];

            }
        }

        SubscriptionPrice::insert($prices);

        return redirect()->route('admin-get-subscription', ['id' => $subscription->id])->with('messages', ['Created successful']);
    }
}