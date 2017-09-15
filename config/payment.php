<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Merchant ID
    |--------------------------------------------------------------------------
    |
    | Merchant ID registered in the Payeer system for which payment will be made.
    |
    */

    'm_shop' => env('M_SHOP'),

    /*
    |--------------------------------------------------------------------------
    | Tariff currency
    |--------------------------------------------------------------------------
    |
    | Supported: "RUB", "USD", "EUR"
    |
    */

    'm_curr' => env('M_CURR', 'RUB'),


    /*
    |--------------------------------------------------------------------------
    | Tariff currency
    |--------------------------------------------------------------------------
    |
    | Supported: "RUB", "USD", "EUR"
    |
    */

    'm_key' => env('M_KEY'),

    'min_sum' => 10,

    'payeer_numer' => env('PAYEER_NUMBER'),
    'payeer_api_id' => env('PAYEER_API_ID'),
    'payeer_api_key' => env('PAYEER_API_KEY'),

    'pay_systems' => [
        '1136053' => [
                'id' => '1136053',
                'name' => 'Payeer',
                'gate_commission' => '0',
                'commission_site_percent' => '0.95',
                'r_fields' => [
                    'ACCOUNT_NUMBER'
                ]
        ],
        '60792237' => [
            'id' => '60792237',
            'name' => 'QIWI',
            'gate_commission' => '2.5',
            'commission_site_percent' => '0.95',
            'r_fields' => [
                'ACCOUNT_NUMBER'
            ]
        ],
        '87893285' => [
            'id' => '87893285',
            'name' => 'Advcash',
            'gate_commission' => '0',
            'commission_site_percent' => '3.9',
            'r_fields' => [
                'ACCOUNT_NUMBER'
            ]
        ],
        '25344' => [
            'id' => '25344',
            'name' => 'Яндекс.Деньги',
            'gate_commission' => '2.5',
            'commission_site_percent' => '2.9',
            'r_fields' => [
                'ACCOUNT_NUMBER'
            ]
        ],
        '24898938' => [
            'id' => '24898938',
            'name' => 'Билайн',
            'gate_commission' => '2',
            'commission_site_percent' => '0',
            'r_fields' => [
                'ACCOUNT_NUMBER'
            ]
        ],
        '24899391' => [
            'id' => '24899391',
            'name' => 'Мегафон',
            'gate_commission' => '2',
            'commission_site_percent' => '0',
            'r_fields' => [
                'ACCOUNT_NUMBER'
            ]
        ],
        '24899291' => [
            'id' => '24899291',
            'name' => 'МТС',
            'gate_commission' => '2',
            'commission_site_percent' => '0',
            'r_fields' => [
                'ACCOUNT_NUMBER'
            ]
        ],
        '95877310' => [
            'id' => '95877310',
            'name' => 'Теле 2',
            'gate_commission' => '2',
            'commission_site_percent' => '0',
            'r_fields' => [
                'ACCOUNT_NUMBER'
            ]
        ]
    ]

];