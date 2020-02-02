<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnProjectTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('project', function (Blueprint $table) {
      $table->integer('scope')->nullable()->comment('0=Red 1=Green 2=yellow');
      $table->integer('quality')->nullable()->comment('0=Red 1=Green 2=yellow');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('project', function (Blueprint $table) {
      $table->dropColumn('scope');
      $table->dropColumn('quality');
    });
  }

}
