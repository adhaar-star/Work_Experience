<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_materials', function (Blueprint $table) {

            $table->increments('material_id')->unsigned();
            $table->integer('company_id');
            $table->integer('material_no');

            $table->integer('material_category_id');
            $table->integer('material_group_id');
            $table->integer('order_unit_id');
            $table->integer('unit_of_measure_id');
            $table->integer('vendor_id');
            $table->integer('currency_id');

            $table->string('name');
            $table->string('description');
            $table->decimal('price');

            $table->integer('stock_item')->nullable();
            $table->integer('min_stock')->nullable();
            $table->integer('reorder_quantity')->nullable();

            $table->string('ean_upc_no')->nullable();
            $table->string('tax_classification')->nullable();
            $table->string('gross_weight', 30)->nullable();
            $table->string('net_weight', 30)->nullable();

            $table->date('expiry_date')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('master_materials');
    }
}
