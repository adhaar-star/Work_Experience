<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PublicHolidays extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('public_holidays', function (Blueprint $table) {
      $table->increments('id');
      $table->date('date');
      $table->string('name_holidays');
      $table->integer('weekend');
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
    Schema::dropIfExists('public_holidays');
  }

}
