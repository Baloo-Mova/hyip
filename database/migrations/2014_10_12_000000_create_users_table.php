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
            $table->string('login');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role');
            $table->double('balance');
            $table->string('phone');
            $table->string('passport');
            $table->integer('subscribe_id');
            $table->timestamp('subscribedFor');
            $table->integer('refferal_id');
            $table->string('ref_link');
            $table->timestamp('last_activity');
            $table->boolean('is_banned');
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
