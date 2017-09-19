<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreeStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('three_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('main_title')->nullable();
            $table->string('first_title')->nullable();
            $table->text('first_text')->nullable();
            $table->string('second_title')->nullable();
            $table->text('second_text')->nullable();
            $table->string('third_title')->nullable();
            $table->text('third_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('three_steps');
    }
}
