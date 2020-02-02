<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnQuantitativeRiskAnalysisTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->dropColumn('quan_entered_by');
            $table->dropColumn('quan_created_on');
            $table->dropColumn('quan_changed_on');
            $table->dropColumn('_token');
            $table->dropColumn('_method');
            $table->dropColumn('risk_type');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->string('quan_entered_by', 30);
            $table->dateTime('quan_created_on');
            $table->dateTime('quan_changed_on');
            $table->string('_token', 200)->nullable();
            $table->string('_method', 10)->nullable();
            $table->string('risk_type', 10)->nullable();
            $table->dropColumn('status');
        });
    }

}
