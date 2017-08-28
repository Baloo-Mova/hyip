<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Feedback\AnswerToFeedbackRequest;
use App\Models\Feedback;
use App\Mail\MailFeedback;
use Illuminate\Http\Request;

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

    public function sendEmail(Request $request, $id)
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

        try{
            \Mail::to($feedback->email, $feedback->name)
                ->send(new MailFeedback($request->get('answer')));

            $feedback->update([
                'is_reply'  => 1,
                'answer'    => $request->get('answer'),
            ]);

            return redirect()->route('admin-feedback-list')->with('messages', ['Send to E-mail']);
        } catch ( \Exception $e ) {
            $error = $e->getMessage();
        }

        return response()->json( [
            'error' => $error
        ] );

    }
}