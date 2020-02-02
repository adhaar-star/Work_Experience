<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMonthYearToTimesheetWeekEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timesheet_week_entries', function (Blueprint $table) {
			$table->string('week_month',128)->nullable()->after('week_number');
			$table->string('week_year',128)->nullable()->after('week_number');				
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timesheet_week_entries', function (Blueprint $table) {
            $table->dropColumn('week_month');
			$table->dropColumn('week_year');
        });
    }
}
