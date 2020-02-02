<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnInEmployeeRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('employee_records', function (Blueprint $table) {

            $table->increments('employee_personnel_number')->first();
            
            $table->string('email')->nullable()->after('employee_last_name');
            
            $table->string('employee_first_name', 100)->nullable()->change();

            $table->string('employee_last_name', 100)->nullable()->change();

            $table->string('employee_user_id')->nullable()->change();

            $table->string('employee_type', 70)->nullable()->change();
            
            $table->integer('employee_cost_centre')->nullable()->change();
            
            $table->integer('employee_activity_type')->nullable()->change();

            $table->integer('employee_timesheet_profile')->nullable()->change();

            $table->string('created_by', 255)->nullable()->change();
            
            $table->string('status')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
