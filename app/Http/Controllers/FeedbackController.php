<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\FeedbackRequest;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController
{
    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), with(new FeedbackRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $user_id = \Auth::id();

        Feedback::create([
            'user_id'   => $user_id,
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'question'  => $request->get('question'),
        ]);


        return redirect()->back()->with('messages', [__("messages.created_successful")]);
    }
}