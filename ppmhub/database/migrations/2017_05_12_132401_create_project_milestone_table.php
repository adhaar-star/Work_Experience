<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectMilestoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('project_milestone', function (Blueprint $table) {

            $table->increments('project_milestone_id')->unsigned();
            $table->integer('milestone_no');
            $table->integer('company_id');
            $table->integer('project_id');
            $table->integer('phase_id');
            $table->integer('task_id')->nullable();
            $table->string('milestone_name')->nullable();
            $table->enum('milestone_type', [ 'billing' , 'progress' ] );
             
            $table->decimal('billing_plan')->nullable();
            $table->decimal('progress')->nullable();

            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->date('fixed_date')->nullable();
            $table->date('actual_date')->nullable();
            $table->date('schedule_date')->nullable();
            $table->date('event_date')->nullable();
             
            $table->tinyInteger('billing_status')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_milestone');
    }
}
