<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeGrIrTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('gr_ir', function($table) {
      $table->renameColumn('debit', 'amount');
      $table->renameColumn('credit', 'dr_cr_indicator');
      $table->string('gl_account')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('gr_ir', function($table) {
      $table->renameColumn('amount', 'debit');
      $table->renameColumn('dr_cr_indicator', 'credit');
      $table->dropColumn('gl_account');
    });
  }

}
