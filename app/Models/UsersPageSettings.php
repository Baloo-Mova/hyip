<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UsersPageSettings
 *
 * @property int $id
 * @property int $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersPageSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UsersPageSettings whereValue($value)
 * @mixin \Eloquent
 */
class UsersPageSettings extends Model
{
    protected $table = 'users_page_settings';

    public $timestamps = true;

    protected $fillable = [
        'value'
    ];
}
