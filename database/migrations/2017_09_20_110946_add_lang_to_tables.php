<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLangToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('head_carousel', function (Blueprint $table) {
            $table->string('lang')->nullable();
        });
        Schema::table('about', function (Blueprint $table) {
            $table->string('lang')->nullable();
        });
        Schema::table('input_output', function (Blueprint $table) {
            $table->string('lang')->nullable();
        });
        Schema::table('faq', function (Blueprint $table) {
            $table->string('lang')->nullable();
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->string('lang')->nullable();
        });
        Schema::table('regulations', function (Blueprint $table) {
            $table->string('lang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('head_carousel', function (Blueprint $table) {
            $table->dropColumn('lang');
        });
        Schema::table('about', function (Blueprint $table) {
            $table->dropColumn('lang');
        });
        Schema::table('input_output', function (Blueprint $table) {
            $table->dropColumn('lang');
        });
        Schema::table('faq', function (Blueprint $table) {
            $table->dropColumn('lang');
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('lang');
        });
        Schema::table('regulations', function (Blueprint $table) {
            $table->dropColumn('lang');
        });
    }
}
