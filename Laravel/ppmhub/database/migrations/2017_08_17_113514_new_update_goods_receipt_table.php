<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewUpdateGoodsReceiptTable extends Migration
{

    public function up()
    {
        Schema::table('goods_receipt_item', function (Blueprint $table) {
            $table->string('company_id')->nullable();
            $table->string('item_cost')->nullable();
            $table->string('project')->nullable();
            $table->string('phase')->nullable();
            $table->string('task')->nullable();
            $table->string('cost_center')->nullable();
            $table->string('gl_account')->nullable();
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
            $table->dropColumn('company_id');
            $table->dropColumn('item_cost');
            $table->dropColumn('project');
            $table->dropColumn('phase');
            $table->dropColumn('task');
            $table->dropColumn('cost_center');
            $table->dropColumn('gl_account');
        });
    }

}
