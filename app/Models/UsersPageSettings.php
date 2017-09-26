<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersPageSettings extends Model
{
    protected $table = 'users_page_settings';

    public $timestamps = true;

    protected $fillable = [
        'value'
    ];
}
