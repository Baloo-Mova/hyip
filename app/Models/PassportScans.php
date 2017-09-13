<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PassportScans
 *
 * @property int $id
 * @property int $user_id
 * @property string $path
 * @property int $is_confirm
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassportScans whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassportScans whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassportScans whereIsConfirm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassportScans wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassportScans whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassportScans whereUserId($value)
 * @mixin \Eloquent
 */
class PassportScans extends Model
{
    protected $table = 'passport_scans';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'path',
        'is_confirm'
    ];
}
