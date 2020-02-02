<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdtColumnTaskSubtaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks_subtask', function (Blueprint $table) {
            $table->string('phase_id')->nullbale()->change();
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
            $table->integer('phase_id')->nullable()->change();
        });
    }
}
