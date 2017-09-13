<?php

namespace App\Models\MainPage;

use Illuminate\Database\Eloquent\Model;

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
