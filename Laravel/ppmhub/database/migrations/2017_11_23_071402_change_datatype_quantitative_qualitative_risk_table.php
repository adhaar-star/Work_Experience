<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDatatypeQuantitativeQualitativeRiskTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
      $table->string('project_id')->change();
    });
    Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
      $table->string('project_id')->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
      $table->integer('project_id')->change();
    });
    Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
      $table->integer('project_id')->change();
    });
  }

}
