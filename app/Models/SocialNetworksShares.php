<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialNetworksShares extends Model
{
    protected $table = 'social_networks_share';

    public $timestamps = false;

    protected $fillable = [
        'text',
        'shares',
    ];
}
