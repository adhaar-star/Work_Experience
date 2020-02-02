<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnTypeSubtaskTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('tasks_subtask', function (Blueprint $table) {
            $table->string('sub_task_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('tasks_subtask', function (Blueprint $table) {
            $table->integer('sub_task_id')->nullable()->change();
        });
    }

}
