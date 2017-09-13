<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PaymentsRequest
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $wallet_id
 * @property int $summ
 * @property int $status
 * @property string|null $comment
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentsRequest whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentsRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentsRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentsRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentsRequest whereSumm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentsRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentsRequest whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PaymentsRequest whereWalletId($value)
 * @mixin \Eloquent
 */
class PaymentsRequest extends Model
{
    protected $table = 'payments_request';

    protected $fillable = [
        'user_id',
        'wallet_id',
        'summ',
        'status',
        'comment',
    ];
}
