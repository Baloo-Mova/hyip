<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'question',
        'answer',
        'is_read',
        'is_reply',
    ];

    public static function hasUnreadFeedback() {
        return \App\Models\Feedback::where('is_read', 0)->count();
    }
}
