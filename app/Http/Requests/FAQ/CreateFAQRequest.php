<?php

namespace App\Http\Requests\FAQ;

use Illuminate\Foundation\Http\FormRequest;

class CreateFAQRequest extends FormRequest
{
    public function rules()
    {
        return [
            'question'  => 'required|string|max:255',
            'answer'    => 'required|string',
        ];
    }
}