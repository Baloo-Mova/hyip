<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PasswordResets
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordResets whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordResets whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordResets whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordResets whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PasswordResets whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PasswordResets extends Model
{
    protected $table = 'password_resets';
    public $timestamps = true;

    protected $fillable = [
        'email',
        'token'
    ];

}
