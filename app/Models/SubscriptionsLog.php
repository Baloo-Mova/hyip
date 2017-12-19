<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubscriptionsLog
 *
 * @property int $id
 * @property int $user_id
 * @property int $subscribe_id
 * @property int $price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionsLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionsLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionsLog wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionsLog whereSubscribeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionsLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionsLog whereUserId($value)
 * @mixin \Eloquent
 */
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
