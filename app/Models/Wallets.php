<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wallets
 *
 * @property int $id
 * @property string $value
 * @property int $user_id
 * @property int $type_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallets whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallets whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallets whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wallets whereValue($value)
 * @mixin \Eloquent
 */
class Wallets extends Model
{
    protected $table = 'wallets';
    protected $fillable = [
        'value',
        'user_id',
        'type_id',
    ];
    public $timestamps = true;
}
