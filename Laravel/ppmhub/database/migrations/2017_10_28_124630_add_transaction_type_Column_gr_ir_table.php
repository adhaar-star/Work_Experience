<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionTypeColumnGrIrTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('gr_ir', function (Blueprint $table) {
      $table->integer('transaction_type')->nullable()->comment('1=GR 2=IR 3=Reversal');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('gr_ir', function (Blueprint $table) {
      $table->dropColumn('transaction_type')->nullable();
    });
  }

}
