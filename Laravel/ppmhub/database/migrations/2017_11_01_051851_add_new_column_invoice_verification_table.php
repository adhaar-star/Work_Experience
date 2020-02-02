<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnInvoiceVerificationTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('invoice_verification_item', function (Blueprint $table) {
      $table->integer('quantity_returned')->nullable()->after('qty_recevied');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('invoice_verification_item', function (Blueprint $table) {
      $table->dropColumn('quantity_returned');
    });
  }

}
