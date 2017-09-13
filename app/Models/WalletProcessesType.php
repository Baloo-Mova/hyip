<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WalletProcessesType
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcessesType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcessesType whereName($value)
 * @mixin \Eloquent
 */
class WalletProcessesType extends Model
{
    const REFERRAL = 1;

    protected $table = 'wallet_processes_type';
    protected $fillable = [
        'id',
        'name',
    ];
    public $timestamps = false;
}
