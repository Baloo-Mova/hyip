<?php

namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;

class CreateAboutRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'     => 'required|string|max:255',
            'uri'       => 'required|string|max:255',
            'content'   => 'required|string',
            'img'       => 'nullable|image',
        ];
    }
}