<?php

namespace App\Models\MainPage;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MainPage\AboutProject
 *
 * @property int $id
 * @property string|null $image
 * @property string $title
 * @property string $description
 * @property string $lang
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\AboutProject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\AboutProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\AboutProject whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\AboutProject whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\AboutProject whereTitle($value)
 * @mixin \Eloquent
 */
class AboutProject extends Model
{
    public $timestamps = false;

    protected $table = 'about_project';

    protected $fillable = [
        'image',
        'title',
        'description',
        'lang'
    ];

}
