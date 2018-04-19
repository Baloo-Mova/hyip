<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Documents
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $is_active
 * @property string|null $lang
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Documents whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Documents whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Documents whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Documents whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Documents whereTitle($value)
 * @mixin \Eloquent
 */
class Documents extends Model
{
    protected $table = 'documents';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'content',
        'lang'
    ];
}
