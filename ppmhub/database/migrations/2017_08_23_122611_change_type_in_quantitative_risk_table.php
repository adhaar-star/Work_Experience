<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeInQuantitativeRiskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->string('quan_total_loss',255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->integer('quan_total_loss')->change();
        });
    }
}
