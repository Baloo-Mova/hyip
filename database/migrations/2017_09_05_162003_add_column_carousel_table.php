<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCarouselTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('head_carousel',function(Blueprint $table){
            $table->string('button_title')->nullable();
            $table->string('button_link')->nullable();
            $table->boolean('show_button')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users',function(Blueprint $table){
            $table->dropColumn('button_title');
            $table->dropColumn('button_link');
            $table->dropColumn('show_button');
        });
    }
}
