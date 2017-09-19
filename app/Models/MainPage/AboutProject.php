<?php

namespace App\Models\MainPage;

use Illuminate\Database\Eloquent\Model;

class AboutProject extends Model
{
    public $timestamps = false;

    protected $table = 'about_project';

    protected $fillable = [
        'image',
        'title',
        'description',
        'lang'
    ];

}
