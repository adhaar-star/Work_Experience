<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePurchaseOrderitemTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchaseorder_item', function (Blueprint $table) {
            $table->dropColumn('purchase_orderno');
            $table->string('requisition_number')->nullable();
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
            $table->string('purchase_orderno', 255)->nullable();
            $table->dropColumn('requisition_number');
        });
    }

}
