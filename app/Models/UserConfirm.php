<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserConfirm
 *
 * @property int $id
 * @property int $user_id
 * @property int $is_read
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConfirm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConfirm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConfirm whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConfirm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserConfirm whereUserId($value)
 * @mixin \Eloquent
 */
class UserConfirm extends Model
{
    protected $table    = 'user_confirm';
    public $timestamps  = true;

    protected $fillable = [
        'user_id',
        'is_read',
    ];

    public static function hasUnread() {
        return \App\Models\UserConfirm::where('is_read', 0)->count();
    }
}
