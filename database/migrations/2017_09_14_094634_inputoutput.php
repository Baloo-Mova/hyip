<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inputoutput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_output', function (Blueprint $table) {
            $table->increments('id');
            $table->string('input_title');
            $table->longText('input_text');
            $table->string('output_title');
            $table->longText('output_text');
            $table->boolean('need_show');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('input_output');
    }
}
