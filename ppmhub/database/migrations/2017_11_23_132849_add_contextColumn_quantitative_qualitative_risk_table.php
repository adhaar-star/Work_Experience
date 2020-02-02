<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContextColumnQuantitativeQualitativeRiskTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
      $table->longText('strategic_context')->nullable();
      $table->longText('organisational_context')->nullable();
      $table->longText('riskmanagement_context')->nullable();
    });
    Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
      $table->longText('strategic_context')->nullable();
      $table->longText('organisational_context')->nullable();
      $table->longText('riskmanagement_context')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
      $table->dropColumn('strategic_context');
      $table->dropColumn('organisational_context');
      $table->dropColumn('riskmanagement_context');
    });
    Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
      $table->dropColumn('strategic_context');
      $table->dropColumn('organisational_context');
      $table->dropColumn('riskmanagement_context');
    });
  }

}
