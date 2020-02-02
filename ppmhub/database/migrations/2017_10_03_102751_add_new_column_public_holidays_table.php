<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnPublicHolidaysTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('public_holidays', function (Blueprint $table) {
      $table->integer('country')->unsigned()->nullable();
      $table->integer('state')->unsigned()->nullable();
      $table->foreign('country')->references('id')->on('country');
      $table->foreign('state')->references('id')->on('state');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('public_holidays', function (Blueprint $table) {
      $table->dropForeign(['country']);
      $table->dropForeign(['state']);
      $table->dropColumn('country');
      $table->dropColumn('state');
    });
  }

}
