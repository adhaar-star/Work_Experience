<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchase_orderno', 50)->nullable();
            $table->string('header_note')->nullable();
            $table->string('approver_1', 50)->nullable();
            $table->string('approver_2', 50)->nullable();
            $table->string('approver_3', 50)->nullable();
            $table->string('approver_4', 50)->nullable();
            $table->string('approved_indicator', 50)->nullable();
            $table->string('approver_token', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order');
    }

}
