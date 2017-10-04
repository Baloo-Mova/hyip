<?php

namespace App\Models\MainPage;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MainPage\Greetings
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $main_title
 * @property string|null $sub_title
 * @property string|null $description
 * @property string|null $lang
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\Greetings whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\Greetings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\Greetings whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\Greetings whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\Greetings whereMainTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\Greetings whereSubTitle($value)
 * @mixin \Eloquent
 */
class Greetings extends Model
{
    public $timestamps = false;

    protected $table = 'greetings';

    protected $fillable = [
        'image',
        'main_title',
        'sub_title',
        'description',
        'lang',
    ];

}
