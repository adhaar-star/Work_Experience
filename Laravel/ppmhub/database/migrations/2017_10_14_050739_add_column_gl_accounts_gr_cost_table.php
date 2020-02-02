<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnGlAccountsGrCostTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('project_gr_cost', function($table) {
      $table->string('gl_account')->nullable();
    });
    Schema::table('cost_centre_cost', function($table) {
      $table->string('gl_account')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('project_gr_cost', function($table) {
      $table->dropColumn('gl_account');
    });
    Schema::table('cost_centre_cost', function($table) {
      $table->dropColumn('gl_account');
    });
  }

}
