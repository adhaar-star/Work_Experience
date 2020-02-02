<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnPurchaseOrderTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('purchase_order', function (Blueprint $table) {
      $table->integer('gr')->nullable();
      $table->integer('ir')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('purchase_order', function (Blueprint $table) {
      $table->dropColumn('gr');
      $table->dropColumn('ir');
    });
  }

}
