<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'name',
        'levels',
        'price',
        'term',
        'description',
        'is_active',
    ];

    public function prices()
    {
        return $this->hasMany(SubscriptionPrice::class);
    }

    public function firstPrices()
    {
        return $this->hasMany(SubscriptionPrice::class)->orderBy('level', 'asc')->limit(3);
    }
}
