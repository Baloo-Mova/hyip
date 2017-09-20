<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $table = 'password_resets';
    public $timestamps = true;

    protected $fillable = [
        'email',
        'token'
    ];

}
