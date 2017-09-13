<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubscriptionPrice
 *
 * @property int $id
 * @property int $subscription_id
 * @property float $value
 * @property int $is_percent
 * @property int $level
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionPrice whereIsPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionPrice whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionPrice whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubscriptionPrice whereValue($value)
 * @mixin \Eloquent
 */
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
