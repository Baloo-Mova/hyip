<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Settings
 *
 * @property int $id
 * @property string|null $smtp
 * @property int|null $smtp_port
 * @property string|null $smtp_login
 * @property string|null $smtp_pasw
 * @property string|null $smtp_secure
 * @property string|null $payeer_number
 * @property string|null $payeer_api_id
 * @property string|null $payeer_api_key
 * @property string|null $payeer_m_shop
 * @property string|null $payeer_m_key
 * @property string|null $min_sum
 * @property string|null $max_sum
 * @property string|null $earned
 * @property string|null $admin_ips
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereAdminIps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereMaxSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereMinSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings wherePayeerApiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings wherePayeerApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings wherePayeerMKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings wherePayeerMShop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings wherePayeerNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSmtp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSmtpLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSmtpPasw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSmtpPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereSmtpSecure($value)
 * @mixin \Eloquent
 */
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
        'received',
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
