<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInvoiceTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('invoice_verification_item', function (Blueprint $table) {
      $table->integer('additional_quantity')->nullable()->after('quantity_returned');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('invoice_verification_item', function (Blueprint $table) {
      $table->dropColumn('additional_quantity');
    });
  }

}
