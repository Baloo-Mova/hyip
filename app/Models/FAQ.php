<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'faq';
    public $timestamps = false;

    protected $fillable = [
        'question',
        'answer',
        'is_active',
    ];
}
