<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'uri',
        'content',
        'photo',
        'preview',
        'published',
    ];


    public function scopePublished()
    {
        return $this->wherePublished(1);
    }
}
