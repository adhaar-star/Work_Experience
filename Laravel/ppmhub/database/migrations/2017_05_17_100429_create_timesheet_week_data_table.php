<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesheetWeekDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheet_week_entries', function (Blueprint $table) {
			$table->increments('timesheet_week_id');       
			$table->integer('employee_id')->length(11);
			$table->integer('week_number')->length(11);
			$table->string('week_dates',255);
			$table->decimal('monday_total_time', 5, 2)->nullable();
			$table->decimal('tuesday_total_time', 5, 2)->nullable();
			$table->decimal('wednesday_total_time', 5, 2)->nullable();
			$table->decimal('thursday_total_time', 5, 2)->nullable();
			$table->decimal('friday_total_time', 5, 2)->nullable();
			$table->decimal('saturday_total_time', 5, 2)->nullable();
			$table->decimal('sunday_total_time', 5, 2)->nullable();
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
