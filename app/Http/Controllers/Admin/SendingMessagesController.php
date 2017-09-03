<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SendingMessages\SendRequest;
use App\Jobs\SendingMessagesToEmail;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SendingMessagesController extends BaseController
{

    private $_model;
    private $_view = 'sending-messages';

    public function __construct(Message $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function index()
    {
        return view('Admin::' . $this->_view . '.form');
    }

    public function send(Request $request)
    {
        $validator = \Validator::make($request->all(), with(new SendRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        $user_id = \Auth::guard('admin')->id();
        $message = $request->get('text');

        switch ($request->get('type')) {
            case 1:
                $user_ids = User::where('id', '!=', $user_id)->get()->pluck('id');
                $res = [];
                foreach ($user_ids as $id) {
                    $res[] = [
                        'from_user' => $user_id,
                        'to_user'   => $id,
                        'message'   => $message,
                        'created_at'=> Carbon::now(),
                        'updated_at'=> Carbon::now(),
                    ];
                }
                Message::insert($res);
                break;
            case 2:
                $emails = User::where('id', '!=', $user_id)->take(2)->get()->pluck('email');
                $job = (new SendingMessagesToEmail($emails, $message))->onQueue('emails');
                dispatch($job);
                break;
        }

        return redirect()->back();
    }
}