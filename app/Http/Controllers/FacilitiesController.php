<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacilitiesController extends Controller
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
        return view('cabinet.facilities.index', [
            'data' => $data
        ]);
    }
    public function operations()
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
        return view('cabinet.facilities.operations', [
            'data' => $data
        ]);
    }
}
