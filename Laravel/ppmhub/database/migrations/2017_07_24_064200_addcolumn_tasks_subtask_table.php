<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddcolumnTasksSubtaskTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('tasks_subtask', function (Blueprint $table) {
            $table->string('duration_unit')->nullable();
            $table->string('completion')->nullable();
            $table->string('total_demand')->nullable();
            $table->string('confirmed_work')->nullable();
            $table->string('remaining_work')->nullable();
            $table->string('cost')->nullable();
            $table->string('revenue')->nullable();
            $table->string('role_assignment')->nullable();
            $table->string('resource_name')->nullable();
            $table->string('r_start_date')->nullable();
            $table->string('r_end_date')->nullable();
            $table->string('worke_assigned')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('tasks_subtask');
    }

}
