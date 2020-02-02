<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGoodsreceiptitemTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_receipt_item', function (Blueprint $table) {
            $table->string('delivery_note')->nullable();
            $table->string('bill_of_lading')->nullable();
            $table->string('status')->nullable();
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
            $table->dropColumn('delivery_note');
            $table->dropColumn('bill_of_lading');
            $table->dropColumn('status');
        });
    }

}
