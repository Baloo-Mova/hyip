<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Referrals
 *
 * @property int $id
 * @property int $user_id
 * @property int $user_ref
 * @property int $user_from
 * @property int $level
 * @property string $user_ref_name
 * @property string|null $user_ref_phone
 * @property float $earned
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $user_from_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereEarned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereUserFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereUserFromName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereUserRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereUserRefName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Referrals whereUserRefPhone($value)
 * @mixin \Eloquent
 */
class Referrals extends Model
{
    public $fillable=[
        'user_id',
        'user_ref',
        'user_from',
        'user_ref_name',
        'user_ref_phone',
        'user_from_name',
        'level',
        'earned',
    ];

    public $timestamps = true;
    public $table='referrals';

    public function refer(){
        return $this->hasOne(User::class, 'id', 'user_ref');
    }
}
