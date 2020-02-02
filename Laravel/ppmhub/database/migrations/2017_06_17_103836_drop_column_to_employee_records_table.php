<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnToEmployeeRecordsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('employee_records', function (Blueprint $table) {
            $table->dropColumn('employee_personnel_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('employee_records', function (Blueprint $table) {
            $table->string('employee_personnel_number', 255);
        });
    }

}
