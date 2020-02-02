<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesheetDayDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('timesheet_day_entries', function (Blueprint $table) {
	   
			$table->increments('timesheet_day_id');   
			
			$table->integer('week_id')->length(11);	
			$table->integer('employee_id')->length(11);
			$table->integer('week_number')->length(11);
			$table->integer('project_id')->length(11);	
			$table->mediumText('project_description')->nullable();
			$table->integer('task_id')->length(11);	
			$table->mediumText('task_description')->nullable();
			$table->date('day_date');
			
			$table->string('billable',50)->nullable();
			
			$table->string('monday_start_time',50)->nullable();
			$table->string('tuesday_start_time',50)->nullable();
			$table->string('wednesday_start_time',50)->nullable();
			$table->string('thursday_start_time',50)->nullable();
			$table->string('friday_start_time',50)->nullable();
			$table->string('saturday_start_time',50)->nullable();
			$table->string('sunday_start_time',50)->nullable();
			
			$table->string('monday_end_time',50)->nullable();
			$table->string('tuesday_end_time',50)->nullable();
			$table->string('wednesday_end_time',50)->nullable();
			$table->string('thursday_end_time',50)->nullable();
			$table->string('friday_end_time',50)->nullable();
			$table->string('saturday_end_time',50)->nullable();
			$table->string('sunday_end_time',50)->nullable();
			
			$table->string('monday_lunch_time',50)->nullable();
			$table->string('tuesday_lunch_time',50)->nullable();
			$table->string('wednesday_lunch_time',50)->nullable();
			$table->string('thursday_lunch_time',50)->nullable();
			$table->string('friday_lunch_time',50)->nullable();
			$table->string('saturday_lunch_time',50)->nullable();
			$table->string('sunday_lunch_time',50)->nullable();
			
			$table->string('monday_worked_time',50)->nullable();
			$table->string('tuesday_worked_time',50)->nullable();
			$table->string('wednesday_worked_time',50)->nullable();
			$table->string('thursday_worked_time',50)->nullable();
			$table->string('friday_worked_time',50)->nullable();
			$table->string('saturday_worked_time',50)->nullable();
			$table->string('sunday_worked_time',50)->nullable();
			
			$table->decimal('monday_time', 5, 2)->nullable();
			$table->decimal('tuesday_time', 5, 2)->nullable();
			$table->decimal('wednesday_time', 5, 2)->nullable();
			$table->decimal('thursday_time', 5, 2)->nullable();
			$table->decimal('friday_time', 5, 2)->nullable();
			$table->decimal('saturday_time', 5, 2)->nullable();
			$table->decimal('sunday_time', 5, 2)->nullable();
			
			$table->integer('employee_cost_centre')->nullable();
			$table->integer('employee_activity_type')->nullable();
			$table->integer('employee_timesheet_profile')->nullable();
			$table->integer('approver_id')->nullable();
			$table->integer('approver_status')->default('0');
			$table->string('changed_by', 255)->nullable();
			$table->string('created_by', 255)->nullable();
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('timesheet_week_entries');
    }
}
