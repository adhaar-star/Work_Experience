<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTaskSubtaskTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('tasks_subtask', function (Blueprint $table) {
            $table->dropColumn(['ref_task', 'ref_template']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::table('tasks_subtask', function (Blueprint $table) {
            $table->string('ref_template', 255)->nullable()->change();
            $table->string('ref_task', 255)->nullable()->change();
        });
    }

}
