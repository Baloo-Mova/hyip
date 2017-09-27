<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Feedback\AnswerToFeedbackRequest;
use App\Models\Feedback;
use App\Mail\MailFeedback;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Session;

class FeedbackController extends BaseController
{
    private $_model;
    private $_view = 'feedback';

    public function __construct(Feedback $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function index($type = 'users')
    {
        switch ($type) {
            case 'users':
                $items = $this->_model->where('user_id', '!=', null)->paginate(15);

                break;
            case 'visitors':
                $items = $this->_model->where('user_id', null)->paginate(15);

                break;
            default:
                $items = $this->_model->where('user_id', '!=', null)->paginate(15);

                break;
        }
        return view('Admin::' . $this->_view . '.list', [
            'items' => $items,
        ]);
    }

    public function show($type, $item_id = null)
    {
        if( empty($item_id) || !is_numeric($item_id) || !($item = $this->_model->find($item_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        $item->update([
            'is_read' => 1,
        ]);

        return view('Admin::' . $this->_view . '.edit', [
            'item' => $item
        ]);
    }

    public function sendEmail(Request $request, $type, $id)
    {
        $validator = \Validator::make($request->all(), with(new AnswerToFeedbackRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        if( empty($id) || !is_numeric($id) || !($feedback = $this->_model->find($id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        $text = $request->get('answer');

        $feedback->update([
            'is_reply'  => 1,
            'answer'    => $request->get('answer'),
        ]);

        try {
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = env("MAIL_HOST");
            $mail->SMTPAuth = true;
            $mail->Username = env("MAIL_USERNAME");
            $mail->Password = env("MAIL_PASSWORD");
            $mail->SMTPSecure = 'ssl';
            $mail->Port = env("MAIL_PORT");
            $mail->CharSet = 'UTF-8';
            $mail->setFrom(env("NO_REPLY_EMAIL"));
            $mail->addAddress($feedback->email);

            $mail->Subject = "Сообщение от техподдержки";
            $mail->Body = $text;
            if(preg_match("/<[^<]+>/", $text, $m) != 0){
                $mail->IsHTML(true);
            }

            $mail->send();
        } catch (\Exception $ex) {
            return redirect(route('admin-feedback-list', ['type' => $type, 'id' => $id]))
                ->withErrors(['Сообщение не отправлено!']);
        }

        Session::flash('messages', ["Сообщение отправлено"]);
        return redirect(route('admin-feedback-list', ['type' => $type, 'id' => $id]))
            ->with('messages', ['Сообщение отправлено!']);

    }

    public function deleteMessage($item_id)
    {
        $feedback = Feedback::find($item_id);
        $feedback->delete();
        Session::flash('messages', ["Сообщение удалено"]);
        return back();
    }
}