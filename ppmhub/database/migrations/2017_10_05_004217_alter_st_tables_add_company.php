<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStTablesAddCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('st_works', function (Blueprint $table) {
            $table->integer('company_id')->after('st_work_id');
        });

        Schema::table('st_work_time', function (Blueprint $table) {
            $table->integer('company_id')->after('st_work_time_id');
            $table->boolean('billable')->after('task_id');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('st_works', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
        Schema::table('st_work_time', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->dropColumn('billable');
        });

    }
}
