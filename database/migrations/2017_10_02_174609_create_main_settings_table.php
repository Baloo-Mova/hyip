<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('smtp', 200)->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('smtp_login', 200)->nullable();
            $table->string('smtp_pasw', 200)->nullable();
            $table->string('smtp_secure', 10)->nullable();
            $table->string('payeer_number', 20)->nullable();
            $table->string('payeer_api_id', 70)->nullable();
            $table->string('payeer_api_key', 70)->nullable();
            $table->string('payeer_m_shop', 100)->nullable();
            $table->string('payeer_m_key', 100)->nullable();
            $table->string('min_sum', 100)->nullable();
            $table->string('max_sum', 100)->nullable();
            $table->text('admin_ips')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
