<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcurementGSTTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('procurement_GST', function (Blueprint $table) {
      $table->increments('id');
      $table->string('gl_account_no')->nullable();
      $table->string('gl_account_description')->nullable();
      $table->string('cost_element_type')->nullable();
      $table->string('amount')->nullable();
      $table->string('dr_cr_indicator')->nullable();
      $table->string('balance')->nullable();
      $table->string('year')->nullable();
      $table->string('period')->nullable();
      $table->string('cleared')->nullable();
      $table->integer('company_id')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('procurement_GST');
  }

}
