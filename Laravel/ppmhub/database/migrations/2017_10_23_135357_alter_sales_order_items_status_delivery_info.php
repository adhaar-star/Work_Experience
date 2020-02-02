<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSalesOrderItemsStatusDeliveryInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_order_items', function (Blueprint $table) {
            $table->dropColumn('sales_order_status');
        });
        Schema::table('sales_order_items', function (Blueprint $table) {
            $table->enum('sales_order_status', [ 'created', 'delivery', 'billing', 'billed', 'success'])->default('created');
            $table->string('delivery_info', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_order_items', function (Blueprint $table) {
            $table->dropColumn('delivery_info');
        });
    }
}
