<?php

namespace App\Http\Requests\Regulations;

use Illuminate\Foundation\Http\FormRequest;

class CreateRegulationsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'     => 'string|max:255',
            'content'   => 'string',
        ];
    }
}