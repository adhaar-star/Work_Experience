<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCrDbGrIrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('gr_ir', function (Blueprint $table) {
            $table->dropColumn('gr_value');
            $table->string('debit')->nullable();
            $table->string('credit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gr_ir', function (Blueprint $table) {
            $table->string('gr_value')->nullable();
            $table->dropColumn('debit');
            $table->dropColumn('credit');
        });
    }
}
