<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Subscription\CreateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\SubscriptionPrice;
use Illuminate\Http\Request;

class SubscriptionController extends BaseController
{
    private $_model;
    private $_view = 'subscriptions';

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

        return view('Admin::' . $this->_view . '.edit', [
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

        if ($request->hasFile('image')) {
            $origext  = $request->file('image')->getClientOriginalExtension();
            $filename = generate_file_name(".{$origext}");
            \Storage::disk('uploads')->put("tariff/$filename", file_get_contents($request->file('image')->getRealPath()));
        }

        $subscription->fill([
            'name'          => $request->get('name'),
            'price'         => $request->get('price'),
            'term'          => $request->get('term'),
            'description'   => $request->get('description'),
            'image'         => isset($filename) ? $filename : $request->get('image'),
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
            SubscriptionPrice::insert($prices);
        }

        return redirect()->route('admin-get-subscription', ['id' => $subscription->id])->with('messages', ['Created successful']);
    }

    public function enable($id)
    {
        $tariff = Subscription::find($id);
        if (!isset($tariff)) {
            return redirect()->route('admin-subscriptions-list')->withErrors(['Такого тарифа не существует!']);
        }
        $tariff->is_active = 1;
        $tariff->save();
        return redirect()->route('admin-subscriptions-list')->withMessages(['Тариф успешно активирован!']);
    }

    public function disable($id)
    {
        $tariff = Subscription::find($id);
        if (!isset($tariff)) {
            return redirect()->route('admin-subscriptions-list')->withErrors(['Такого тарифа не существует!']);
        }
        $tariff->is_active = 0;
        $tariff->save();
        return redirect()->route('admin-subscriptions-list')->withMessages(['Тариф успешно деактивирован!']);
    }

    public function deleteImg($id = null)
    {
        $tariff = Subscription::find($id);

        if(!isset($tariff)){
            return redirect(route('admin-subscriptions-list'))
                ->withErrors('Записи с таким ID не существует!');
        }

        \Storage::disk('uploads')->delete("tariff/$tariff->image");

        $tariff->image = null;
        $tariff->save();

        return redirect()->route('admin-get-subscription', ['item' => $tariff]);
    }

    public function deleteItem($id)
    {
        $tariff = Subscription::find($id);

        if(!isset($tariff)){
            return redirect(route('admin-subscriptions-list'))
                ->withErrors('Записи с таким ID не существует!');
        }

        if(isset($tariff->image)){
            \Storage::disk('uploads')->delete("tariff/$tariff->image");
        }

        $tariff->delete();

        return redirect()->route('admin-subscriptions-list')
                ->withMessages(['Запись удалена!']);
    }
}