<?php

namespace App\Http\Requests\Facilities;

use Illuminate\Foundation\Http\FormRequest;

class RefillRequest extends FormRequest
{
    public function rules()
    {
        return [
            'count' => 'required|integer',
        ];
    }
}