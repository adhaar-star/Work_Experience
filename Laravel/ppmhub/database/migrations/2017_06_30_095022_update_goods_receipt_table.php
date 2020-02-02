<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGoodsReceiptTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_receipt', function (Blueprint $table) {
            $table->string('purchase_order_number')->nullable();
            $table->string('purchase_order_item_no')->nullable();
            $table->string('item_description')->nullable();
            $table->string('vendor_number')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('purchase_order_quantity')->nullable();
            $table->string('quantity_received')->nullable();
            $table->string('quantity_remaining')->nullable();
            $table->string('document_date')->nullable();
            $table->string('posting_date')->nullable();
            $table->string('delivery_note')->nullable();
            $table->string('bill_of_lading')->nullable();
            $table->string('created_by')->nullable();
            $table->string('created_on')->nullable();
            $table->string('changed_by')->nullable();
            $table->string('changed_on')->nullable();
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
            $table->dropColumn('purchase_order_number');
            $table->dropColumn('purchase_order_item_no');
            $table->dropColumn('item_description');
            $table->dropColumn('vendor_number');
            $table->dropColumn('vendor_name');
            $table->dropColumn('purchase_order_quantity');
            $table->dropColumn('quantity_received');
            $table->dropColumn('quantity_remaining');
            $table->dropColumn('document_date');
            $table->dropColumn('posting_date');
            $table->dropColumn('delivery_note');
            $table->dropColumn('bill_of_lading');
            $table->dropColumn('created_by');
            $table->dropColumn('created_on');
            $table->dropColumn('changed_by');
            $table->dropColumn('changed_on');
        });
    }

}
