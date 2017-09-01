<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
