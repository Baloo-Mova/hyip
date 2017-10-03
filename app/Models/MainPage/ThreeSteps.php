<?php

namespace App\Models\MainPage;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MainPage\ThreeSteps
 *
 * @property int $id
 * @property string|null $main_title
 * @property string|null $first_title
 * @property string|null $first_text
 * @property string|null $second_title
 * @property string|null $second_text
 * @property string|null $third_title
 * @property string|null $third_text
 * @property string|null $lang
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\ThreeSteps whereFirstText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\ThreeSteps whereFirstTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\ThreeSteps whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\ThreeSteps whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\ThreeSteps whereMainTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\ThreeSteps whereSecondText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\ThreeSteps whereSecondTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\ThreeSteps whereThirdText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\ThreeSteps whereThirdTitle($value)
 * @mixin \Eloquent
 */
class ThreeSteps extends Model
{
    public $timestamps = false;

    protected $table = 'three_steps';

    protected $fillable = [
        'main_title',
        'first_title',
        'first_text',
        'second_title',
        'second_text',
        'third_title',
        'third_text',
        'lang',
    ];

}
