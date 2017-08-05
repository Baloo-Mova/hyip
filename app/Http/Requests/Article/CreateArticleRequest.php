<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title'            => 'required|string|max:255',
            'uri'              => 'required|max:255',
            'content'          => 'string',
        ];
    }
}