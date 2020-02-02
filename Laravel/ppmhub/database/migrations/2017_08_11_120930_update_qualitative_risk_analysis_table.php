<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQualitativeRiskAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->integer('qual_changed_by')->nullable()->change();
            $table->string('qual_status')->nullable()->change();
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
             $table->integer('qual_changed_by')->change();
             $table->tinyInteger('qual_status')->change();
        });
    }
}
