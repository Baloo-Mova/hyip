<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePassportScans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('passport_scans', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->string('preview')->nullable();
            $table->dropColumn('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('passport_scans', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('preview');
            $table->string('path');
        });
    }
}
