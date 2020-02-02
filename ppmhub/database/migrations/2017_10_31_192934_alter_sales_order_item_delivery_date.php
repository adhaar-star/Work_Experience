<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSalesOrderItemDeliveryDate extends Migration
{

    public function up()
    {
        Schema::table('sales_order_items', function (Blueprint $table) {
            $table->date('delivery_date')->nullable()->after('delivery_info');
        });
    }


    public function down()
    {
        Schema::table('sales_order_items', function (Blueprint $table) {
            $table->dropColumn('delivery_date');
        });
    }
}
