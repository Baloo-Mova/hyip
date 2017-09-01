<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    public function index()
    {
        $data = [
            'contacts' =>[
                'social' => [
                    'vk' => [
                        'img' => 'img/vk', 'link' => 'http://google.com.ua'
                    ],
                    'instagram' => [
                        'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                    ]
                ]
            ]
        ];

        $subscriptions = Subscription::where('is_active', 1)->get();

        return view('cabinet.tariff.index', [
            'data'          => $data,
            'subscriptions' => $subscriptions
        ]);
    }

    public function pay(Request $request, $id)
    {
        if( empty($id) || !is_numeric($id) || !($subscription = Subscription::find($id)) ) {
            return redirect()->route('tariff')->withErrors('Тариф не найден');
        }
        dd($subscription);
    }
}
