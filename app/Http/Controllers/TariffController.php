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

        $tariff_config = \Config('tariff');
        $m_shop =  $tariff_config['m_shop'];
        $m_orderid = mt_rand();
        $m_amount = number_format($subscription->price, 2, '.', '');
        $m_curr = $tariff_config['m_curr'];
        $m_desc = base64_encode('Пополнение баланса');
        $m_key = $tariff_config['m_key'];
        $arParams = [
            'success_url'   => route('tariff') . "/$id/success",
            'fail_url'      => route('tariff') . "/$id/fail",
            'status_url'    => route('tariff') . "/$id/status",

        ];
        $key = md5('Ключ для шифрования дополнительных параметров'.$m_orderid);
        $m_params = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, json_encode($arParams), MCRYPT_MODE_ECB)));

        $arHash = [
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc,
            $m_key,
            $m_params
        ];
        dd($arHash);

        $sign = strtoupper(hash('sha256', implode(':', $arHash)));

        return redirect("https://payeer.com/merchant/?m_shop=$m_shop&m_orderid=$m_orderid&m_amount=$m_amount&m_curr=$m_curr&m_desc=$m_desc&m_params=$m_params&m_sign=$sign");
    }
}
