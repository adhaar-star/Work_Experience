<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_records', function (Blueprint $table) {
            $table->increments('employee_id')->unsigned();
            $table->string('employee_personnel_number',255);
            $table->string('employee_first_name',100);
            $table->string('employee_middle_name',100)->nullable();
            $table->string('employee_last_name',100);
            $table->date('employee_dob')->nullable();
            $table->integer('employee_user_id');
            $table->string('employee_birth_country',100)->nullable();
            $table->string('employee_type',70);
            $table->integer('employee_cost_centre');
            $table->integer('employee_activity_type');
            $table->string('employee_role',50)->nullable();
            $table->integer('employee_timesheet_profile');
            $table->date('employee_start')->nullable();
            $table->date('employee_end')->nullable();
            $table->string('changed_by',255)->nullable();
            $table->string('created_by',255);
            $table->tinyInteger('status')->default(1);
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
       Schema::dropIfExists('employee_records');
    }
}
