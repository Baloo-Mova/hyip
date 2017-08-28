<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class AnswerToFeedbackRequest extends FormRequest
{
    public function rules()
    {
        return [
            'answer' => 'required',
        ];
    }
}