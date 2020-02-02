<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_item', function (Blueprint $table) {
            $table->string('status',50)->nullable();
            $table->string('requisition_number',255)->nullable();
            $table->integer('item_no')->nullable();
            $table->string('item_category',191)->nullable();
            $table->string('material',191)->nullable();
            $table->string('material_description',255)->nullable();    
            $table->integer('item_quantity')->nullable();
            $table->string('quantity_unit')->nullable();
            $table->integer('item_cost')->nullable();
            $table->string('currency',50)->nullable();
            $table->dateTime('delivery_date',50)->nullable();
            $table->string('material_group',50)->nullable();
            $table->string('vendor',50)->nullable();
            $table->string('requestor',50)->nullable();
            $table->string('contract_number',50)->nullable();
            $table->string('contract_item_number',50)->nullable();
            $table->integer('purchase_order_number')->nullable();
        });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('purchase_item', function (Blueprint $table) {
            Schema::dropIfExists('purchase_item');
        });
    }
}
