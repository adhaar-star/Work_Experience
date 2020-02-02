<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandForecastTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('demand_forecasting', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('project_id')->unsigned();
      $table->foreign('project_id')->references('id')->on('project');
      $table->string('forecast');
      $table->string('forecast_total');
      $table->integer('company_id');
      $table->dateTime('start_date');
      $table->dateTime('end_date');
      $table->string('changed_by');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('demand_forecasting');
  }

}
