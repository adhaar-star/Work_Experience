<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRevenueServiceOffering extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revenue_service_offer_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_number')->nullable();
            $table->string('task')->nullable();
            $table->string('resource_role')->nullable();
            $table->string('personal_no')->nullable();
            $table->string('resource_name')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('type')->nullable();
            $table->string('hours')->nullable();
            $table->string('total_hours')->nullable();
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
        Schema::table('revenue_service_offer', function (Blueprint $table) {
            Schema::dropIfExists('revenue_service_offer');
        });
    }
}
