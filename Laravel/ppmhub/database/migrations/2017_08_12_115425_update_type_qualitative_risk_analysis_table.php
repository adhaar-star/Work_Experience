<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTypeQualitativeRiskAnalysisTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->string('qual_impact')->change();
            $table->string('qual_probability')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->tinyInteger('qual_impact')->change();
            $table->tinyInteger('qual_probability')->change();
        });
    }

}
