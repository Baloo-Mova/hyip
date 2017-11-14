<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImgTo3Steps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('three_steps', function(Blueprint $table){
            $table->string('first_img', 191)->nullable();
            $table->string('second_img', 191)->nullable();
            $table->string('third_img', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('three_steps', function(Blueprint $table){
            $table->dropColumn('first_img');
            $table->dropColumn('second_img');
            $table->dropColumn('third_img');
        });
    }
}
