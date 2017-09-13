<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialNetwork;

class SupportController extends Controller
{
    public function index()
    {
        $social = SocialNetwork::all();
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => $social,
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
        return view('cabinet.support.index', ['data' => $data] );
    }
}
