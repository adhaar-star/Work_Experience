<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRiskMitigationActionQualitativeQuantitativeRiskAnalysis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->string('risk_mitigation_action',250);           
        });
        
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->string('risk_mitigation_action',250);           
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
            $table->dropColumn('risk_mitigation_action');           
        });
        
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->dropColumn('risk_mitigation_action');           
        });
    }
}
