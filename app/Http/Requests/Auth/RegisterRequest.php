<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'login'             => 'required|max:50|unique:users,login',
            'phone'             => 'required|max:50|unique:users,phone',
            'email'             => 'required|email|max:50|unique:users,email',
            'password'          => 'required|min:6|max:16',
            'confirm_password'  => 'same:password',
        ];
    }

    public function authorize(){
        return true;
    }
}