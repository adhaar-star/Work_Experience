<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRiskScoreColumnQualitativeRiskAnalysisTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->string('risk_score')->nullable()->after('qual_probability');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->dropColumn('risk_score');
        });
    }

}
