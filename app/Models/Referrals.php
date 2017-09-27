<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referrals extends Model
{
    public $fillable=[
        'user_id',
        'user_ref',
        'user_from',
        'user_ref_name',
        'user_ref_phone',
        'user_from_name',
        'level',
        'earned',
    ];

    public $timestamps = true;
    public $table='referrals';

    public function getUser(){
        $this->hasOne(User::class, 'user_id');
    }
}
