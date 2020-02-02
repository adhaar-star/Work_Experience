<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectResourcePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('project_resource_plan', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('resource_plan_Id',255)->nullable();
            $table->string('resource_plan_name',255)->nullable();
            $table->string('resource_plan_type',255)->nullable();
            $table->integer('project_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('a_start_date')->nullable();
            $table->dateTime('l_start_date')->nullable();
            $table->dateTime('l_end_date')->nullable();
            $table->dateTime('e_start_date')->nullable();
            $table->dateTime('e_end_date')->nullable();
            $table->dateTime('a_end_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('duration')->nullable();
            $table->string('persion_responsible',255)->nullable();
            $table->string('phase_approval',255)->nullable();
            $table->string('template',255)->nullable();
            $table->string('reference_phase',255)->nullable();
            $table->string('quality_approval',255)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->dateTime('modified_date')->nullable();
            $table->string('status')->default('active');
            $table->string('is_deleted')->default('N');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('project_resource_plan');
    }
}
