<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnPortfolioResourcePlanningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolio_resource_planning', function (Blueprint $table) {
            $table->integer('planning_type')->nullable();
            $table->integer('view_type')->nullable();
            $table->integer('costing_type')->nullable();
            $table->integer('collection_type')->nullable();
            $table->string('bucket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('portfolio_resource_planning');
    }
}
