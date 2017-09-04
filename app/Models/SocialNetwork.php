<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialNetwork extends Model
{
    protected $table = 'social_networks';

    protected $fillable = [
        'name',
        'link',
        'img_url',
        'black_img_url',
        'is_active',
    ];
}
