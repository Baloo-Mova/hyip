<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role');
            $table->double('balance');
            $table->string('phone')->nullable();
            $table->integer('subscribe_id')->nullable();
            $table->timestamp('subscribedFor')->nullable();
            $table->integer('referral_id')->nullable();
            $table->string('ref_link');
            $table->timestamp('last_activity');
            $table->boolean('is_banned')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
