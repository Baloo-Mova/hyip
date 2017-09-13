<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Models\MainPage\HeaderCarousel;
use Illuminate\Http\Request;

class CarouselController extends BaseController
{
    private $_model;
    private $_view = 'content.carousel';

    public function __construct(HeaderCarousel $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

}
