<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserConfirm extends Model
{
    protected $table    = 'user_confirm';
    public $timestamps  = true;

    protected $fillable = [
        'user_id',
        'is_read',
    ];

    public static function hasUnread() {
        return \App\Models\UserConfirm::where('is_read', 0)->count();
    }
}
