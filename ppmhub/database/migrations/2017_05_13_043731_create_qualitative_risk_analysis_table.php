<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualitativeRiskAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualitative_risk_analysis', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('qual_risk_id',30);
            $table->string('project_id');
            $table->tinyInteger('qual_category');
            $table->text('qual_risk_desc');
            $table->tinyInteger('qual_impact');
            $table->tinyInteger('qual_probability');
            $table->dateTime('qual_created_on');
            $table->integer('qual_created_by');
            $table->dateTime('qual_changed_on');
            $table->integer('qual_changed_by');
            $table->tinyInteger('qual_status');
            $table->string('_token',100);
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('qualitative_risk_analysis');
    }
}
