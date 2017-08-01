<?php

namespace App\Http\Requests\Message;

use Illuminate\Foundation\Http\FormRequest;

class CreateMessageRequest extends FormRequest
{
    public function rules()
    {
        return [
            'to_user'   => 'required|exists:users,id',
            'message'   => 'required|string',
        ];
    }
}