<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SocialNetworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_networks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link');
            $table->string('img_url');
            $table->string('black_img_url');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_networks');
    }
}
