<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateWalletProcesses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallet_processes', function (Blueprint $table) {
            $table->integer('status')->default(0);
            $table->string('card_number')->nullable();
            $table->string('pay_system')->nullable();
            $table->string('contact_person')->nullable();
            $table->text('comment')->nullable();
            $table->dropColumn('wallet_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallet_processes', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('card_number');
            $table->dropColumn('pay_system');
            $table->dropColumn('contact_person');
            $table->dropColumn('comment');
            $table->integer('wallet_id');
        });
    }
}
