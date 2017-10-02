<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    public $timestamps = false;
    protected $fillable = [
        'smtp',
        'smtp_port',
        'smtp_login',
        'smtp_pasw',
        'smtp_secure',
        'payeer_number',
        'payeer_api_id',
        'payeer_api_key',
        'payeer_m_shop',
        'payeer_m_key',
        'min_sum',
        'max_sum',
        'admin_ips'
    ];
}
