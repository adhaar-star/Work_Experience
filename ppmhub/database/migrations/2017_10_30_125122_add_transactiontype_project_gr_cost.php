<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactiontypeProjectGrCost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
    Schema::table('project_gr_cost', function (Blueprint $table) {
      $table->integer('transaction_type')->nullable()->comment('1=GR 2=IR 3=GR Reversal 4=IR Reversal');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('project_gr_cost', function (Blueprint $table) {
      $table->dropColumn('transaction_type');
    });
  }
}
