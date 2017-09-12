<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassportData extends Model
{
    protected $table = 'passport_data';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'passport_data',
    ];
}
