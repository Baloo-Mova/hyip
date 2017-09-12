<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialNetwork
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string|null $img
 * @property string|null $black_img
 * @property int $is_active
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetwork whereBlackImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetwork whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetwork whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetwork whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetwork whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetwork whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetwork whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SocialNetwork whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
