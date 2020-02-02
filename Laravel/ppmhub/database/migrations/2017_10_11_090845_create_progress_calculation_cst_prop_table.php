<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgressCalculationCstPropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('progress_calculation_cost_proportional', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->nullable();
            $table->integer('method')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();

            $table->double('planned_progress', 15, 2)->nullable();
            $table->double('actual_progress', 15, 2)->nullable();
            $table->double('planned_cost', 15, 2)->nullable();
            $table->double('actual_cost', 15, 2)->nullable();

            $table->double('BCWS', 15, 2)->nullable();
            $table->double('BCWP', 15, 2)->nullable();
            $table->double('ACWP', 15, 2)->nullable();
            $table->double('cost_variance', 15, 2)->nullable();
            $table->double('schedule_variance', 15, 2)->nullable();
            $table->double('value_variance', 15, 2)->nullable();
            $table->double('value_index', 15, 2)->nullable();
            

            $table->integer('created_by')->nullable();
            $table->integer('changed_by')->nullable();
            $table->integer('company_id')->nullable();
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
        Schema::dropIfExists('progress_calculation_cost_proportional');
    }
}
