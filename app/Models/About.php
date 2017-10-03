<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\About
 *
 * @property int $id
 * @property string $title
 * @property string $uri
 * @property string $content
 * @property string|null $img
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereUri($value)
 * @mixin \Eloquent
 * @property string|null $lang
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\About whereLang($value)
 */
class About extends Model
{
    protected $table = 'about';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'uri',
        'content',
        'img',
        'is_active',
        'lang'
    ];
}
