<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Feedback
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 * @property string $email
 * @property string $question
 * @property string|null $answer
 * @property int $is_read
 * @property int $is_reply
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereIsReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUserId($value)
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'question',
        'answer',
        'is_read',
        'is_reply',
    ];

    public static function hasUnreadFeedback() {
        return \App\Models\Feedback::where('is_read', 0)->count();
    }
}
