<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item')->nullable();
            $table->string('sales_orderno')->nullable();
            $table->string('material_number')->nullable();
            $table->string('order_qty')->nullable();
            $table->string('material_description')->nullable();
            $table->date('first_delivery_date')->nullable();
            $table->integer('net_value')->nullable();    
            $table->string('currency')->nullable();
            $table->date('pricing_date')->nullable();
            $table->string('usage')->nullable();
            $table->string('unloading_point')->nullable();
            $table->string('shipping_point')->nullable();
            $table->string('gross_weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->string('net_weight')->nullable();
            $table->string('volume')->nullable();
            $table->string('volume_unit')->nullable();
            $table->string('billing_block')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sales_item');
    }
}
