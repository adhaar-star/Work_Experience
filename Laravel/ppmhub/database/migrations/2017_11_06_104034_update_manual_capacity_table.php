<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateManualCapacityTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('manual_capacity', function (Blueprint $table) {
      $table->string('category')->nullable()->change();
      $table->string('group')->nullable()->change();
      $table->string('view')->nullable()->change();
      $table->renameColumn('amount', 'hours_day');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('manual_capacity', function (Blueprint $table) {
      $table->integer('category')->change();
      $table->integer('group')->change();
      $table->integer('view')->change();
      $table->renameColumn('hours_day', 'amount');
    });
  }

}
