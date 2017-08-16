<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPrice extends Model
{
    protected $table    = 'subscription_prices';
    public $timestamps  = false;

    protected $fillable = [
        'subscription_id',
        'value',
        'is_percent',
        'level',
    ];
}
