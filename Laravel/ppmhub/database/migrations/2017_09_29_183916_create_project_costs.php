<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_costs', function (Blueprint $table) {

            $table->increments('project_cost_id');
            $table->integer('employee_id');
            $table->integer('project_id');
            $table->integer('task_id');

            $table->integer('activity_type_id');
            $table->integer('activity_rate_id');

            $table->time('total_time');
            $table->integer('total_minutes');

            $table->decimal('activity_rate');
            $table->decimal('total_cost', 8,2);
            $table->tinyInteger('billing_status')->default(0);
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
        Schema::dropIfExists('project_costs');
    }
}
