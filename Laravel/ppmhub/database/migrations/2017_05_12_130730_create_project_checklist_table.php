<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectChecklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_checklist', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('checklist_id')->nullable();
            $table->string('checklist_name')->nullable();
            $table->string('checklist_type')->nullable();
            $table->string('project_name')->nullable();
            $table->string('project_id')->nullable();
            $table->string('phase_id')->nullable();
            $table->string('phase_name')->nullable();
            $table->string('task_id')->nullable();
            $table->string('task_name')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('a_start_date')->nullable();
            $table->dateTime('l_start_date')->nullable();
            $table->dateTime('l_end_date')->nullable();
            $table->dateTime('e_start_date')->nullable();
            $table->dateTime('e_end_date')->nullable();
            $table->dateTime('a_end_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('duration')->nullable();
            $table->string('person_responsible')->nullable();
            $table->string('created_by')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->string('changed_by')->nullable();
            $table->string('changed_on')->nullable();
            $table->string('status')->default('active');
     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_checklist');
    }
}
