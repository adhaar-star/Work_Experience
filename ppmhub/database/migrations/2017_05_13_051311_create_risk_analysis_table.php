<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiskAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('risk_analysis', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('risk_id',50);
            $table->integer('project_id');
            $table->integer('category');
            $table->text('risk_desc');
            $table->integer('total_loss');
            $table->integer('probabiltiy');
            $table->float('expected_loss');
            $table->tinyInteger('qualitative_impact');
            $table->tinyInteger('qualitative_prob');
            $table->integer('quantative_prob');
            $table->integer('entered_by');
            $table->dateTime('entered_on');
            $table->integer('changed_by');
            $table->dateTime('changed_on');
            $table->tinyInteger('status')->default(1);
            $table->timestamp('last_updation');
           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('risk_analysis');
    }
}
