<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyEmployeeRecordsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_records', function (Blueprint $table) {
            $table->dropColumn('employee_personnel_number');
            $table->renameColumn('email', 'email_id');
            $table->integer('employee_user_id')->change();
            $table->integer('created_by')->change();
            $table->dropColumn('changed_by');
            $table->integer('updated_by')->nullable()->after('created_by');
            $table->integer('company_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_records', function (Blueprint $table) {
            $table->string('employee_personnel_number')->after('employee_id');
            $table->renameColumn('email_id', 'email');
            $table->string('employee_user_id')->change();
            $table->string('created_by')->change();
            $table->dropColumn('updated_by');
            $table->string('changed_by')->nullable()->after('created_by');
            $table->string('company_id')->change();
        });
    }
}
