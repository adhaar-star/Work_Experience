<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCrDbCostCenterCostTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_centre_cost', function (Blueprint $table) {
            $table->dropColumn('value');
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
        Schema::table('cost_centre_cost', function (Blueprint $table) {
            $table->string('value')->nullable();
            $table->dropColumn('debit');
            $table->dropColumn('credit');
        });
    }

}
