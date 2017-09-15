<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    protected $table = 'wallets';
    protected $fillable = [
        'value',
        'user_id',
        'type_id',
    ];
    public $timestamps = true;
}
