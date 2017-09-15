<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\SocialNetwork;

class SupportController extends Controller
{
    public function index()
    {

        $social = SocialNetwork::where(['is_active' => 1])->get();
        $user = \Auth::user();
        $feedbacks = Feedback::where(['user_id' => $user->id])->paginate(10);
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('cabinet.support.index', [
            'data' => $data,
            'user' => $user,
            'feedbacks' => $feedbacks
        ] );
    }

    public function show($id)
    {
        $feedback = Feedback::find($id);
        $social = SocialNetwork::where(['is_active' => 1])->get();
        $data = [
            'contacts' =>[
                'social' => [
                    'links' => $social
                ]
            ]
        ];
        return view('cabinet.support.show', [
            'data' => $data,
            'feedback' => $feedback
        ] );
    }
}
