<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creator_id');
            $table->integer('to_id');
            $table->timestamps();
        });
        Schema::table('messages', function (Blueprint $table) {
            $table->integer('chat_id')->after('to_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('chat_id');
        });
    }
}
