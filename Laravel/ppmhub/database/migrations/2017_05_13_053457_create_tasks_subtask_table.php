<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksSubtaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tasks_subtask', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('task_Id',255)->nullable();
            $table->string('task_name',255)->nullable();
            $table->string('task_type',255)->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('phase_id')->nullable();
            $table->integer('sub_task_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('a_start_date')->nullable();
            $table->dateTime('l_start_date')->nullable();
            $table->dateTime('l_end_date')->nullable();
            $table->dateTime('e_start_date')->nullable();
            $table->dateTime('e_end_date')->nullable();
            $table->dateTime('a_end_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('duration')->nullable();
            $table->integer('persion_responsible')->nullable();
            $table->string('phase_approval',255)->nullable();
            $table->string('ref_template',255)->nullable();
            $table->string('ref_task',255)->nullable();
            $table->dateTime('created_date')->nullable();
            $table->dateTime('modified_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
            $table->string('status')->default('active');
            $table->string('is_deleted')->default('N');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('tasks_subtask');
    }
}
