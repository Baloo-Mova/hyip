<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubscriptionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'      => 'required|string|max:255',
            'price'     => 'required|integer',
            'term'      => 'required|integer',
            'levels'    => 'required|integer',
        ];
    }
}