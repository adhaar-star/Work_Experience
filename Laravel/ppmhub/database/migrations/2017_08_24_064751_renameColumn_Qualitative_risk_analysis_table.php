<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnQualitativeRiskAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->renameColumn('qual_impact', 'qual_likelihood');
            $table->renameColumn('qual_probability', 'qual_consequence');
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
            $table->renameColumn('qual_likelihood', 'qual_impact');
            $table->renameColumn('qual_consequence', 'qual_probability');
        });
    }
}
