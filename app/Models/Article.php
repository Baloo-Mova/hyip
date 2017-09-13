<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property string $title
 * @property string $uri
 * @property string $content
 * @property string|null $photo
 * @property string|null $preview
 * @property int $published
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article published()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article wherePreview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTypeId($value)
 * @mixin \Eloquent
 */
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
        'type_id'
    ];


    public function scopePublished()
    {
        return $this->wherePublished(1);
    }

    public function scopeBlog()
    {
        return $this->whereTypeId(1);
    }

    public function scopeStock()
    {
        return $this->whereTypeId(2);
    }
}
