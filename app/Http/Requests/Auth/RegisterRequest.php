<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email'             => 'required|email|max:50',
            'password'          => 'required|min:6|max|16',
            'confirm_password'  => 'same:password',
        ];
    }
}