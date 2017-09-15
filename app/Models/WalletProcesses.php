<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WalletProcesses
 *
 * @property int $id
 * @property int $wallet_id
 * @property int $type_id
 * @property string $time
 * @property int $value
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereWalletId($value)
 * @mixin \Eloquent
 */
class WalletProcesses extends Model
{
    protected $table = 'wallet_processes';
    protected $fillable = [
        'wallet_id',
        'type_id',
        'time',
        'value',
    ];

    public function getType()
    {
        return $this->hasOne(WalletProcessesType::class, 'id', 'type_id');
    }
}
