<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cabinet\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

use Auth, Validator;

class CabinetController extends Controller
{
    public function index(Request $request)
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

        $response = view('cabinet.index', [
            'user' => \Auth::user(),
            'data' => $data
        ]);

        if (Auth::user()->status == 0) {
            $response = $response->withErrors(['email' => 'Ваш email не подтвержден!']);
        }
        
        return $response;
    }

    public function userUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), with(new UserUpdateRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();

        if ($request->file('photo')) {
            $path = $request->file('photo')->getPath();
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            Passport::create([
                'user_id' => $user_id,
                'img' => $base64,
            ]);
        }

        $user->update([
            'phone' => $request->get('phone'),
        ]);

        return redirect()->route('cabinet')
            ->with(['message' => trans('backend.create_success')]);
    }
}