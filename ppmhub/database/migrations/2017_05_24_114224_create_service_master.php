<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('service_master', function (Blueprint $table) {
            $table->increments('service_id')->unsigned();
            $table->string('service_name')->nullable();
            $table->string('service_description',240)->nullable();
            $table->string('short_text',24)->nullable();
            $table->string('service_category')->nullable();
            $table->string('service_group')->nullable();
            $table->string('supplier')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->string('ordering_unit')->nullable();
            $table->string('contractor_name')->nullable();
            $table->string('tax_classification')->nullable();
            $table->string('validity_start')->nullable();
            $table->string('validity_end')->nullable();
            $table->string('standard_rate')->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('service_master');
    }
}
