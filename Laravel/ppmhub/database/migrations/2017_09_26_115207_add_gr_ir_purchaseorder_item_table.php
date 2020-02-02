<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGrIrPurchaseorderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchaseorder_item', function (Blueprint $table) {
            $table->string('ir')->nullable();
            $table->string('gr')->nullable();
          
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
            $table->dropColumn('ir');
            $table->dropColumn('gr');
        });
    }

}
