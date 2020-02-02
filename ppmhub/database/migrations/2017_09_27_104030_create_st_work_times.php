<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStWorkTimes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_work_time', function (Blueprint $table) {
            $table->increments('st_work_time_id');

            $table->integer('company_id');
            $table->integer('st_work_id');
            $table->integer('project_id');
            $table->integer('task_id');

            $table->time('total_time');
            $table->integer('total_minutes');
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
        Schema::dropIfExists('st_work_time');
    }
}
