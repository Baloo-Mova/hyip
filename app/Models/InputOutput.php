<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\InputOutput
 *
 * @property int $id
 * @property string $input_title
 * @property string $input_text
 * @property string $output_title
 * @property string $output_text
 * @property int $need_show
 * @property string|null $lang
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InputOutput whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InputOutput whereInputText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InputOutput whereInputTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InputOutput whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InputOutput whereNeedShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InputOutput whereOutputText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\InputOutput whereOutputTitle($value)
 * @mixin \Eloquent
 */
class InputOutput extends Model
{
    protected $table = 'input_output';
    public $timestamps = false;

    protected $fillable = [
        'input_title',
        'input_text',
        'output_title',
        'output_text',
        'need_show',
        'lang'
    ];
}
