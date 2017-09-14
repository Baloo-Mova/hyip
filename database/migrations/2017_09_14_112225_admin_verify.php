<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminVerify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('is_confirm')->default(0)->comment('Верификация доков админом');
        });
        Schema::table('passport_scans', function (Blueprint $table) {
            $table->dropColumn('is_confirm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_confirm');
        });
        Schema::table('passport_scans', function (Blueprint $table) {
            $table->boolean('is_confirm')->default(0);
        });
    }
}
