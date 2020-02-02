<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManualCapacityPlanningTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('manual_capacity', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('portfolio');
      $table->integer('bucket');
      $table->integer('category');
      $table->integer('group');
      $table->integer('view');
      $table->integer('planning_unit')->comment('1=Monthly , 2=Weekly , 3=Quartely , 4=Half Yearly , 5=Annualy');
      $table->integer('amount');
      $table->date('start_date');
      $table->date('end_date');
      $table->string('status');
      $table->integer('company_id');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('manual_capacity');
  }

}
