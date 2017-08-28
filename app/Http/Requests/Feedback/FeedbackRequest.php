<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255',
            'question'  => 'required',
            'is_read'   => 'boolean',
        ];
    }
}