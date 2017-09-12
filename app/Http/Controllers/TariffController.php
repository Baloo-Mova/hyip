<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    public function index($id)
    {
        $tariffs = Subscription::where('is_active', 1)->with(['firstPrices'])->get();
        $tariff = Subscription::find($id);
        if(isset($tariff)){
            $subscriptionPrices = $tariff->firstPrices;
        }
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ]
                ]
            ]
        ];
        return view('cabinet.tariff.index', [
            'data' => $data,
            'tariffs' => $tariffs,
            'tariff_info' => isset($tariff) ? $tariff : "",
            "subscription" => isset($subscriptionPrices) ? $subscriptionPrices : ""
        ]);
    }

    public function pay(Request $request, $id)
    {
        if( empty($id) || !is_numeric($id) || !($subscription = Subscription::find($id)) ) {
            return redirect()->route('tariff', ['id' => -1])->withErrors('Тариф не найден');
        }
        dd($subscription);
    }

    public function getTariffInfo($id)
    {
        $tariff = Subscription::find($id);
        if(!isset($tariff)){
            return false;
        }
        $prices = $tariff->firstPrices->toArray();
        return json_encode(['success' => true, 'info' => $tariff, 'prices' => $prices]);
    }
}
