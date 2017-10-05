<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SocialNetwork;

class TariffController extends Controller
{
    public function index($id)
    {
        $tariffs = Subscription::where('is_active', 1)->with(['firstPrices'])->get();

        if($id != -1){
            $tariff = Subscription::find($id);
        }else{
            $uid = \Auth::user()->subscribe_id;
            if(isset($uid)){
                $tariff = Subscription::find($uid);
            }
        }

        $social = SocialNetwork::where(['is_active' => 1])->get();
        if (isset($tariff)) {
            $subscriptionPrices = $tariff->firstPrices;
        }
        $data = [
            'contacts' => [
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('cabinet.tariff.index', [
            'data' => $data,
            'user' => \Auth::user(),
            'tariffs' => $tariffs,
            'tariff_info' => isset($tariff) ? $tariff : "",
            "subscription" => isset($subscriptionPrices) ? $subscriptionPrices : ""
        ]);
    }

    public function pay(Request $request, $id)
    {
        $subscription = Subscription::with(['prices'])->find($id);

        if (!isset($subscription) || $subscription->is_active == 0) {
            return back()->withErrors([__("messages.tariff_notfind")]);
        }

        $user = \Auth::user();


        if ($user->balance < $subscription->price) {
            return back()->withErrors([
                __("messages.insufficient_funds").' <a href="' . route('facilities', ['type' => 'input']) . '">'.__("messages.refill").'</a>, '.__("messages.bill_please").' .'
            ]);
        }

        $user->payToReferrals($subscription);

        $user->subscribedFor = $user->subscribe_id != $subscription->id ?
            Carbon::now()->addDays($subscription->term) :
            Carbon::parse($user->subscribedFor)->addDays($subscription->term);
        $user->subscribe_id = $subscription->id;
        $user->balance = $user->balance - $subscription->price;
        $user->save();

        \Session::flash('messages', [__("messages.success_subscribe") ." ". $subscription->name . '. '.__("messages.nice_earning")]);

        return redirect(route('tariff', ['index' => -1]));
    }

    public function getTariffInfo($id)
    {
        $tariff = Subscription::find($id);
        if (!isset($tariff)) {
            return false;
        }
        $prices = $tariff->firstPrices->toArray();
        return json_encode(['success' => true, 'info' => $tariff, 'prices' => $prices]);
    }
}
