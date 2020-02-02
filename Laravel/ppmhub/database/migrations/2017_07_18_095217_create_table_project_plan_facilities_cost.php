<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProjectPlanFacilitiesCost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_facilities_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_number')->nullable();
            $table->string('task')->nullable();
            $table->string('facilities')->nullable();
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
        Schema::table('project_facilities_cost', function (Blueprint $table) {
            Schema::dropIfExists('project_facilities_cost');
        });
    }
}
