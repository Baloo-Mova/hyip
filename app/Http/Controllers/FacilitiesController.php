<?php

namespace App\Http\Controllers;

use App\Http\Requests\Facilities\RefillRequest;
use App\Models\PaymentsRequest;
use App\Models\User;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    public function index()
    {
        $data = [
            'contacts' => [
                'social' => [
                    'links' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ],
                    'share' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'fb' => [
                            'img' => 'img/fb', 'link' => 'http://google.com.ua'
                        ],
                        'ok' => [
                            'img' => 'img/ok', 'link' => 'http://google.com.ua'
                        ],
                        'tw' => [
                            'img' => 'img/tw', 'link' => 'http://google.com.ua'
                        ],
                        'tl' => [
                            'img' => 'img/tl', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ]
                ]
            ]
        ];
        return view('cabinet.facilities.index', [
            'data' => $data
        ]);
    }

    public function operations()
    {
        $data = [
            'contacts' => [
                'social' => [
                    'links' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ],
                    'share' => [
                        'vk' => [
                            'img' => 'img/vk', 'link' => 'http://google.com.ua'
                        ],
                        'fb' => [
                            'img' => 'img/fb', 'link' => 'http://google.com.ua'
                        ],
                        'ok' => [
                            'img' => 'img/ok', 'link' => 'http://google.com.ua'
                        ],
                        'tw' => [
                            'img' => 'img/tw', 'link' => 'http://google.com.ua'
                        ],
                        'tl' => [
                            'img' => 'img/tl', 'link' => 'http://google.com.ua'
                        ],
                        'instagram' => [
                            'img' => 'img/instagram', 'link' => 'http://google.com.ua'
                        ]
                    ]
                ]
            ]
        ];
        return view('cabinet.facilities.operations', [
            'data' => $data
        ]);
    }

    public function refill(RefillRequest $request)
    {
        $user_id = \Auth::id();

        $payment = PaymentsRequest::create([
            'user_id' => $user_id,
            'summ' => $request->get('count'),
            'status' => 0,
            'comment' => 'refill',
        ]);

        $payment_config = config('payment');

        $m_shop = $payment_config['m_shop'];
        $m_orderid = $payment->id;
        $m_amount = number_format($request->get('count'), 2, '.', '');
        $m_curr = $payment_config['m_curr'];
        $m_desc = base64_encode('Пополнение баланса');
        $m_key = $payment_config['m_key'];

        $arHash = [
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc,
            $m_key,
        ];

        $sign = strtoupper(hash('sha256', implode(':', $arHash)));

        return redirect("https://payeer.com/merchant/?m_shop=$m_shop&m_orderid=$m_orderid&m_amount=$m_amount&m_curr=$m_curr&m_desc=$m_desc&m_sign=$sign");
    }

    public function getResultRefill(Request $request, $type)
    {
        if (!in_array($_SERVER['REMOTE_ADDR'], ['185.71.65.92', '185.71.65.189', '149.202.17.210'])) return;
        file_put_contents(storage_path('app/testP.txt'), json_encode($request->all()), 8);
        $m_key = \Config('payment.m_key');
        $m_shop = $request->get('m_shop');
        $m_orderid = $request->get('m_orderid');
        $m_amount = $request->get('m_amount');
        $m_curr = $request->get('m_curr');
        $m_desc = $request->get('m_desc');
        $checksum = $request->get('m_sign');
        if (isset($_POST['m_operation_id']) && isset($checksum)) {
            $arHash = array($m_shop, $m_orderid, $m_amount, $m_curr, $m_desc, $m_key);
            $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
            if ($checksum == $sign_hash) {
                $payment = PaymentsRequest::find($m_orderid);
                switch ($type) {
                    case 'success':
                        $payment->update([
                            'status' => 1
                        ]);
                        $user = User::find($payment->user_id);
                        $user->balance += $m_amount;
                        $user->update();
                        break;
                    case 'fail':
                        $payment->update([
                            'status' => -1
                        ]);
                        break;
                    case 'status':
                        file_put_contents(storage_path('app/testP.txt'), json_encode($request->all()));
                        break;
                }
            }
        }
        return redirect()->route('facilities')->withErrors('Ошибка оплаты');
    }
}
