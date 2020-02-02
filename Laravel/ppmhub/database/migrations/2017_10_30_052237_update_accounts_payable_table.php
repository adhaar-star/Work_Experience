<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAccountsPayableTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('accounts_payable', function($table) {
      $table->renameColumn('credit', 'amount');
      $table->renameColumn('debit', 'dr_cr_indicator');
    });
    Schema::table('accounts_payable', function($table) {
      $table->string('dr_cr_indicator')->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('accounts_payable', function($table) {
      $table->renameColumn('amount', 'credit');
      $table->renameColumn('dr_cr_indicator', 'debit');
    });
    Schema::table('accounts_payable', function($table) {
      $table->integer('debit')->change();
    });
  }

}
