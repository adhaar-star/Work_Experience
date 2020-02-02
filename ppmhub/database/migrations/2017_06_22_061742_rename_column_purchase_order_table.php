<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnPurchaseOrderTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->renameColumn('purchase_orderno', 'purchase_order_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('purchase_order', function (Blueprint $table) {
            $table->renameColumn('purchase_order_number','purchase_orderno');
        });
    }

}
