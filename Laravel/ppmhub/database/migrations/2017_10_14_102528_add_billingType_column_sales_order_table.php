<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBillingTypeColumnSalesOrderTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('sales_order', function (Blueprint $table) {
      $table->integer('billing_type')->after('requested_by')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('sales_order', function (Blueprint $table) {
      $table->dropColumn('billing_type');
    });
  }

}
