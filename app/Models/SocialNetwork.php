<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    protected $table = 'social_networks';

    protected $fillable = [
        'name',
        'link',
        'img',
        'black_img',
        'is_active',
    ];
}
