<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectMaterialCostTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_material_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_number')->nullable();
            $table->string('task')->nullable();
            $table->string('material_number')->nullable();
            $table->string('description')->nullable();
            $table->string('quantity')->nullable();
            $table->string('type')->nullable();
            $table->string('unit_price')->nullable();
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
        Schema::table('project_material_cost', function (Blueprint $table) {
            Schema::dropIfExists('project_material_cost');
        });
    }

}
