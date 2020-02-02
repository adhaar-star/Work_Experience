<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTravelCostTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_travel_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_number')->nullable();
            $table->string('task')->nullable();
            $table->string('travel_request_number')->nullable();
            $table->string('currency')->nullable();
            $table->string('total_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_travel_cost', function (Blueprint $table) {
            Schema::dropIfExists('project_travel_cost');
        });
    }

}
