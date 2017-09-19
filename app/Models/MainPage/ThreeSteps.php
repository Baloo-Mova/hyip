<?php

namespace App\Models\MainPage;

use Illuminate\Database\Eloquent\Model;

class ThreeSteps extends Model
{
    public $timestamps = false;

    protected $table = 'three_steps';

    protected $fillable = [
        'main_title',
        'first_title',
        'first_text',
        'second_title',
        'second_text',
        'third_title',
        'third_text',
    ];

}
