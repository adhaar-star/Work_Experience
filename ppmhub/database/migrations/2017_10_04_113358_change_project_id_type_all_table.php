<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProjectIdTypeAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('tasks_subtask', function (Blueprint $table) {
            $table->string('project_id')->change();
        });
//        Schema::table('project_milestone', function (Blueprint $table) {
//            $table->string('project_id')->change();
//        });
        Schema::table('project_cost_plan', function (Blueprint $table) {
            $table->string('project_id')->change();
        });
        Schema::table('component', function (Blueprint $table) {
            $table->string('project_id')->change();
        });
        Schema::disableForeignKeyConstraints();
        Schema::table('cost_forecasting', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
        });
        Schema::table('cost_forecasting', function (Blueprint $table) {
            $table->string('project_id')->change();
        });
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->string('project_id')->change();
        });
        Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->string('project_id')->change();
        });
        Schema::table('st_work_time', function (Blueprint $table) {
            $table->string('project_id')->change();
        });
        Schema::table('sprint', function (Blueprint $table) {
            $table->string('project_id')->change();
        });
        Schema::table('revenue_forecasting', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
        });
        Schema::table('revenue_forecasting', function (Blueprint $table) {
            $table->string('project_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('tasks_subtask', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });
        Schema::table('project_milestone', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });
        Schema::table('project_cost_plan', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });
        Schema::table('component', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });
        Schema::table('cost_forecasting', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });
        Schema::table('qualitative_risk_analysis', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });
        Schema::table('quantitative_risk_analysis', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });
        Schema::table('st_work_time', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });
        Schema::table('sprint', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });
        Schema::table('revenue_forecasting', function (Blueprint $table) {
            $table->integer('project_id')->change();
        });
    }
}
