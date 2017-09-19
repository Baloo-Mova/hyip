<?php

namespace App\Models\MainPage;

use Illuminate\Database\Eloquent\Model;

class Greetings extends Model
{
    public $timestamps = false;

    protected $table = 'greetings';

    protected $fillable = [
        'image',
        'main_title',
        'sub_title',
        'description',
        'lang',
    ];

}
