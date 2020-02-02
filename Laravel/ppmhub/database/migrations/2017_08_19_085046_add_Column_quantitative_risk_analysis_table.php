<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnQuantitativeRiskAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->string('quan_risk_desc')->after('quan_category');
            $table->integer('quan_risk_score')->after('quan_probability');
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
            $table->dropColumn('quan_risk_desc');
            $table->dropColumn('quan_risk_score');
        });
    }
}
