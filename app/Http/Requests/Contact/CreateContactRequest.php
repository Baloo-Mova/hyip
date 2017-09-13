<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type_id'  => 'required',
            'value' => 'required|string|max:255',
        ];
    }
}