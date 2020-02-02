<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdQualitativeAnalysisTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->integer('company_id')->after('qual_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }

}
