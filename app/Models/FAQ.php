<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FAQ
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ whereQuestion($value)
 * @mixin \Eloquent
 * @property string|null $lang
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FAQ whereLang($value)
 */
class FAQ extends Model
{
    protected $table = 'faq';
    public $timestamps = false;

    protected $fillable = [
        'question',
        'answer',
        'is_active',
        'lang'
    ];
}
