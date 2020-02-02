<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnGoodsreceiptTable extends Migration
{

    public function up()
    {
        Schema::table('goods_receipt', function (Blueprint $table) {
            $table->dropColumn('purchase_order_number');
            $table->dropColumn('purchase_order_item_no');
            $table->dropColumn('item_description');
            $table->dropColumn('vendor_name');
            $table->dropColumn('purchase_order_quantity');
            $table->dropColumn('quantity_received');
            $table->dropColumn('quantity_remaining');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_receipt', function (Blueprint $table) {
            $table->string('purchase_order_number')->nullable();
            $table->string('purchase_order_item_no')->nullable();
            $table->string('item_description')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('purchase_order_quantity')->nullable();
            $table->string('quantity_received')->nullable();
            $table->string('quantity_remaining')->nullable();
        });
    }

}
