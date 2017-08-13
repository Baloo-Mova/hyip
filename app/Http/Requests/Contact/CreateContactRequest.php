<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'  => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ];
    }
}