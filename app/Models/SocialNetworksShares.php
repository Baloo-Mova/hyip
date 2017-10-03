<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialNetworksShares
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $shares
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetworksShares whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetworksShares whereShares($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetworksShares whereText($value)
 * @mixin \Eloquent
 */
class SocialNetworksShares extends Model
{
    protected $table = 'social_networks_share';

    public $timestamps = false;

    protected $fillable = [
        'text',
        'shares',
    ];
}
