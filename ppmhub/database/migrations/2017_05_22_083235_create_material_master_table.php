<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_master', function (Blueprint $table) {
            $table->increments('material_number');
            $table->string('material_name')->nullable();
            $table->string('material_description')->nullable();
            $table->string('material_category')->nullable();
            $table->string('material_group')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('unit_of_measure')->nullable();
            $table->string('ordering_unit')->nullable();
            $table->string('standard_price')->nullable();
            $table->string('stock_item')->nullable();
            $table->string('EAN_UPC_number')->nullable();
            $table->string('tax_classification')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('min_stock')->nullable();
            $table->string('reorder_quantity')->nullable();
            $table->string('gross_weight')->nullable();
            $table->string('nett_weight')->nullable();
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
        Schema::dropIfExists('material_master');

    }
}
