<?php

namespace App\Http\Requests\SendingMessages;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
{
    public function rules()
    {
        return [
            'text'   => 'required|string',
            'type'   => 'required|in:1,2',
        ];
    }
}