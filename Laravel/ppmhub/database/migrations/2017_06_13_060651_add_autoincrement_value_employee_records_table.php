<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutoincrementValueEmployeeRecordsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        $statement = "ALTER TABLE employee_records AUTO_INCREMENT = 10000001;";
        DB::unprepared($statement);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        $statement = "ALTER TABLE employee_records AUTO_INCREMENT = 1;";
        DB::unprepared($statement);
    }

}
