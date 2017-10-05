<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionsLog extends Model
{
    protected $table = 'subscriptions_log';
    protected $fillable = [
        'user_id',
        'subscribe_id',
        'price'
    ];
    public $timestamps = true;
}
