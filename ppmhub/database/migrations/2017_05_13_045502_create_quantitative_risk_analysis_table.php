<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantitativeRiskAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('quantitative_risk_analysis', function (Blueprint $table) {
            $table->increments('quan_id')->unsigned();
            $table->string('project_id')->nullable();
            $table->string('quan_risk_id',50)->nullable();
            $table->tinyInteger('quan_category');
            $table->string('quan_risk_desc')->unique();
            $table->integer('quan_total_loss');
            $table->string('quan_currency',50);
            $table->integer('quan_probability');
            $table->string('quan_risk_score')->unique();
            $table->float('quan_expected_loss',11,2);
            $table->string('quan_entered_by',30);
            $table->dateTime('quan_created_on');
            $table->integer('quan_created_by');
            $table->dateTime('quan_changed_on');
            $table->integer('quan_changed_by');
            $table->string('_token',200)->nullable();
            $table->string('_method',10)->nullable();
            $table->string('risk_type',10)->nullable();
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
        Schema::dropIfExists('quantitative_risk_analysis');
    }
}
