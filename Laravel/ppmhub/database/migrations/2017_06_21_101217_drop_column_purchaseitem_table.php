<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnPurchaseitemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   Schema::table('purchase_item', function (Blueprint $table) {
            $table->dropColumn('approver_1');
            $table->dropColumn('approver_2');
            $table->dropColumn('approver_3');
            $table->dropColumn('approver_4');	 		
	});
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
      public function down()
    {
         Schema::table('purchase_item', function (Blueprint $table) {
            $table->string('approver_1',50)->nullable();
            $table->string('approver_2',50)->nullable();
            $table->string('approver_3',50)->nullable();
            $table->string('approver_4',50)->nullable();
        });
    }
}
