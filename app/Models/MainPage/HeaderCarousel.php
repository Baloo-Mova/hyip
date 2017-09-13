<?php

namespace App\Models\MainPage;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MainPage\HeaderCarousel
 *
 * @property int $id
 * @property string $background_file
 * @property string $text
 * @property int $need_show
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\HeaderCarousel whereBackgroundFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\HeaderCarousel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\HeaderCarousel whereNeedShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MainPage\HeaderCarousel whereText($value)
 * @mixin \Eloquent
 */
class HeaderCarousel extends Model
{
    protected $table = "head_carousel";
    public $timestamps = false;
    protected $fillable = [
        'background_file',
        'text',
        'need_show',
        'button_title',
        'button_link',
        'show_button',
    ];
}
