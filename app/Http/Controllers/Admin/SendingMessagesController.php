<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SendingMessages\SendRequest;
use App\Jobs\SendingMessagesToEmail;
use App\Jobs\SendMessagesToAll;
use App\Models\Message;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        $this->dispatch(new SendMessagesToAll($request->get('type'), $message, $user_id));

        Session::flash('messages', ['Рассылка сообщений успешно начата!']);
        return redirect()->back();
    }
}