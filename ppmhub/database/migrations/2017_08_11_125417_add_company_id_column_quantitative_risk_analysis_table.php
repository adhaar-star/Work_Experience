<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdColumnQuantitativeRiskAnalysisTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->integer('company_id');
            $table->integer('quan_changed_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->integer('quan_changed_by')->change();
        });
    }

}
