<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCreatedonDatatypeCustomerinquiryTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('customer_inquiry', function (Blueprint $table) {
      $table->date('created_on')->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('customer_inquiry', function (Blueprint $table) {
      $table->dateTime('created_on')->change();
    });
  }

}
