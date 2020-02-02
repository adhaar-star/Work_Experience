<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumGlRecordsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('gl_records', function (Blueprint $table) {
      $table->string('invoice_number')->nullable();
      $table->string('posting_date')->nullable();
      $table->string('posted_by')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('gl_records', function (Blueprint $table) {
      $table->dropColumn('invoice_number');
      $table->dropColumn('posting_date');
      $table->dropColumn('posted_by');
    });
  }

}
