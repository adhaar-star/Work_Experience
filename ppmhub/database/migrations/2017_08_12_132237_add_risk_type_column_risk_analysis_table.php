<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRiskTypeColumnRiskAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->string('risk_type')->nullable();
        });
        
         Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->string('risk_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->dropColumn('risk_type');
        });
        
         Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->dropColumn('risk_type');
        });
    }
}
