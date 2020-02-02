<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnTaskSubtaskTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('tasks_subtask', function (Blueprint $table) {
      $table->string('pre_task_id')->after('sub_task_id')->nullable();
      $table->string('successor_task_id')->before('start_date')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('tasks_subtask', function (Blueprint $table) {
      $table->dropColumn('pre_task_id');
      $table->dropColumn('successor_task_id');
    });
  }

}
