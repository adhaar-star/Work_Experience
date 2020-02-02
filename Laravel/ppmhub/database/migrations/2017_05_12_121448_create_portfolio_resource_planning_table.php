<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioResourcePlanningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('portfolio_resource_planning', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('resource_planning_id')->nullable();
            $table->string('resource_planning_name',128)->nullable();
            $table->integer('portfolio_id')->nullable();;
            $table->string('portfolio_name',128)->nullable();
            $table->integer('total_period')->nullable();
            $table->string('distribute',10)->nullable();
            $table->string('planning_start',100)->nullable();
            $table->string('planning_end',100)->nullable();
            $table->integer('planning_unit')->nullable();
            $table->integer('added_by')->nullable();
            $table->string('created_by',128)->nullable();
            $table->timestamp('created_date')->nullable();
            $table->string('edited_by')->nullable();
            $table->dateTime('edited_date')->nullable();
            $table->string('status')->default('active');
            $table->string('is_delete')->default('no');
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
         Schema::dropIfExists('portfolio_resource_planning');
    }
}
