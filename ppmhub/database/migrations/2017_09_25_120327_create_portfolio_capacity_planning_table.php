<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioCapacityPlanningTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('portfolio_capacity_planning', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('portfolio_id')->nullable();
            $table->integer('total_period')->nullable();
            $table->string('distribute', 10)->nullable();
            $table->string('planning_start', 100)->nullable();
            $table->string('planning_end', 100)->nullable();
            $table->string('created_by', 128)->nullable();
            $table->date('created_date')->nullable();
            $table->string('edited_by')->nullable();
            $table->date('edited_date')->nullable();
            $table->string('status')->default('active');
            $table->integer('planning_type')->nullable();
            $table->integer('view_type')->nullable();
            $table->integer('costing_type')->nullable();
            $table->integer('collection_type')->nullable();
            $table->integer('bucket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('portfolio_capacity_planning');
    }

}
