<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Regulations
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $is_active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Regulations whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Regulations whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Regulations whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Regulations whereTitle($value)
 * @mixin \Eloquent
 */
class Regulations extends Model
{
    protected $table = 'regulations';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'is_active',
    ];
}
