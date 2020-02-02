<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsReceiptItemTable extends Migration
{

    public function up()
    {
        Schema::create('goods_receipt_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_receipt_no')->nullable();
            $table->string('purchase_order_number')->nullable();
            $table->string('purchase_order_item_no')->nullable();
            $table->string('item_description')->nullable();
            $table->string('vendor_number')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('purchase_order_quantity')->nullable();
            $table->string('quantity_received')->nullable();
            $table->string('quantity_remaining')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_receipt_item', function (Blueprint $table) {
            Schema::dropIfExists('goods_receipt_item');
        });
    }

}
