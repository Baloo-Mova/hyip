<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSocialLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('social_networks', function (Blueprint $table) {
            $table->dropColumn('type_id');
            $table->dropColumn('img');
            $table->dropColumn('black_img');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_networks', function (Blueprint $table) {
            $table->integer('type_id')->default(1)->comment('1 - линк, 2 - линк поделиться');
            $table->string('img')->nullable();
            $table->string('black_img')->nullable();
        });
    }
}
