<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQtyPurhcaseorderItemTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchaseorder_item', function (Blueprint $table) {
            $table->integer('item_quantity_gr')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchaseorder_item', function (Blueprint $table) {
            
            $table->dropColumn('item_quantity_gr');
        });
    }

}
