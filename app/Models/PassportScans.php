<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassportScans extends Model
{
    protected $table = 'passport_scans';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'path',
        'is_confirm'
    ];
}
