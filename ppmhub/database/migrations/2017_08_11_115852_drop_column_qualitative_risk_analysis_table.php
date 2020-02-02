<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnQualitativeRiskAnalysisTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->dropColumn('qual_created_on');
            $table->dropColumn('qual_changed_on');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->dateTime('qual_created_on');
            $table->dateTime('qual_changed_on');
        });
    }

}
