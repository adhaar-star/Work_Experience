<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInProjectTaskTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks_subtask', function (Blueprint $table) {
            $table->string('weighting_factor')->nullable();
            $table->string('planned_cost')->nullable();
            $table->string('actual_cost')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks_subtask', function (Blueprint $table) {
            $table->dropColumn('weighting_factor');
            $table->dropColumn('planned_cost');
            $table->dropColumn('actual_cost');
        });
    }

}
