<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentTransactiontypeColumnGrIrTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('gr_ir', function (Blueprint $table) {
      $table->integer('transaction_type')->comment('1=GR 2=IR 3=GR Reversal 4=IR Reversal')->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('gr_ir', function (Blueprint $table) {
      $table->integer('transaction_type')->comment('1=GR 2=IR 3=Reversal')->change();
    });
  }

}
