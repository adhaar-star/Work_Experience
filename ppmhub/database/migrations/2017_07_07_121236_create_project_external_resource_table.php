<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectExternalResourceTable extends Migration
{

    public function up()
    {
        Schema::create('project_external_resource_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_number')->nullable();
            $table->string('task')->nullable();
            $table->string('resource role')->nullable();
            $table->string('resource_id')->nullable();
            $table->string('resource_name')->nullable();
            $table->string('contract_vendor')->nullable();
            $table->string('purchase_order')->nullable();
            $table->string('no_hours')->nullable();
            $table->string('unit_rate')->nullable();
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
        Schema::table('project_external_resource_cost', function (Blueprint $table) {
            Schema::dropIfExists('project_external_resource_cost');
        });
    }

}
