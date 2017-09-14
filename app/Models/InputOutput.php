<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];
}
