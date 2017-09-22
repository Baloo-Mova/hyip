<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property string $name
 * @property int $levels
 * @property int $price
 * @property int $term
 * @property string|null $description
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubscriptionPrice[] $firstPrices
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubscriptionPrice[] $prices
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereLevels($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereTerm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'name',
        'levels',
        'price',
        'term',
        'description',
        'image',
        'is_active',
    ];

    public function prices()
    {
        return $this->hasMany(SubscriptionPrice::class);
    }

    public function firstPrices()
    {
        return $this->hasMany(SubscriptionPrice::class)->orderBy('level', 'asc');
    }
}
