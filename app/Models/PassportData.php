<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PassportData
 *
 * @property int $id
 * @property int $user_id
 * @property string $passport_data
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassportData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassportData wherePassportData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PassportData whereUserId($value)
 * @mixin \Eloquent
 */
class PassportData extends Model
{
    protected $table = 'passport_data';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'passport_data',
    ];

    public static function createDefault($userId)
    {
        return self::create([
            'user_id' => $userId,
            'passport_data' => json_encode([
                'name' => '',
                'surname' => '',
                'middleName' => '',
                'series' => '',
                'number' => '',
                'issuedby' => '',
                'dateofissue' => '',
                'is_confirm' => false
            ]),
        ]);
    }

    public function dataToArray()
    {
        return json_decode($this->passport_data);
    }
}
