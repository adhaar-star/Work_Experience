<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('project_Id',255)->nullable();
            $table->integer('portfolio_type')->nullable();
            $table->string('project_name',100)->nullable();
            $table->text('project_desc',128)->nullable();
            $table->integer('project_type')->nullable();
            $table->integer('portfolio_id')->nullable();
            $table->integer('bucket_id')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->dateTime('a_start_date')->nullable();
            $table->dateTime('a_end_date')->nullable();
            $table->dateTime('f_start_date')->nullable();
            $table->dateTime('f_end_date')->nullable();
            $table->dateTime('sch_date')->nullable();
            $table->dateTime('p_start_date')->nullable();
            $table->dateTime('p_end_date')->nullable();
            $table->integer('person_responsible')->nullable();
            $table->integer('factory_calendar')->nullable();
            $table->string('currency',50)->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('cost_centre')->nullable();
            $table->integer('department')->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('modified_by',50)->nullable();
            $table->dateTime('created_date')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->string('status')->default('active');
            $table->string('deleted')->default('N');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('project');
    }
}
