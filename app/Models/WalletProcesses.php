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
 * @property int $from_id
 * @property int $status
 * @property string|null $card_number
 * @property string|null $pay_system
 * @property string|null $contact_person
 * @property string|null $comment
 * @property int $to_id
 * @property-read \App\Models\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses bonuses()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses wherePaySystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WalletProcesses whereToId($value)
 */
class WalletProcesses extends Model
{
    const REFERRALS = 1;
    const INPUT = 2;
    const OUTPUT = 3;
    const BONUS = 4;

    const STATUS_UNREAD = 0;
    const STATUS_ACCEPT = 1;
    const STATUS_DECLINE = 2;

    protected $table = 'wallet_processes';
    protected $fillable = [
        'wallet_id',
        'type_id',
        'time',
        'value',
        'status',
        'card_number',
        'comment',
        'pay_system',
        'contact_person',
        'from_id',
        'to_id'
    ];

    public function getType()
    {
        return $this->hasOne(WalletProcessesType::class, 'id', 'type_id');
    }

    public static function hasWithdraws() {
        return \App\Models\WalletProcesses::where(['type_id' => 3, 'status' => 0])->count();
    }
    public static function getWithdraws($status) {
        if($status == 3){
            return \App\Models\WalletProcesses::where(['type_id' => 3])->orderBy('time', 'desc')->get();
        }else{
            return \App\Models\WalletProcesses::where(['type_id' => 3, 'status' => $status])->orderBy('time', 'desc')->get();
        }
    }

    public function scopeBonuses()
    {
        return $this->where(['type_id' => $this::BONUS])->orderBy("time", "desc");
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'to_id');
    }
}
