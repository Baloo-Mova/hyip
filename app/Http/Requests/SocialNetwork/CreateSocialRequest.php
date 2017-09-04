<?php

namespace App\Http\Requests\SocialNetwork;

use Illuminate\Foundation\Http\FormRequest;

class CreateSocialRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'      => 'required|string|max:255',
            'link'      => 'required|string|max:255',
            'img'       => 'image',
            'black_img' => 'image',
        ];
    }
}