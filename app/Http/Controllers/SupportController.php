<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialNetwork;

class SupportController extends Controller
{
    public function index()
    {
        $social = SocialNetwork::link()->get();
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('cabinet.support.index', ['data' => $data] );
    }
}
