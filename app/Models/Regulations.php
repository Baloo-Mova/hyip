<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regulations extends Model
{
    protected $table = 'regulations';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'is_active',
    ];
}
