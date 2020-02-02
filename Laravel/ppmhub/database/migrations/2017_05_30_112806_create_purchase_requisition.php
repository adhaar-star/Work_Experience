<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequisition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('purchase_requisition', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('requisition_number',255)->nullable();
            $table->string('requested_by',255)->nullable();
            $table->string('requisition_short_description',255)->nullable();
            $table->string('vendor',50)->nullable();
            $table->string('requesting_department',50)->nullable();
            $table->string('project_id',255)->nullable();
            $table->string('phase_id',255)->nullable();
            $table->string('task_id',255)->nullable();
            $table->string('purchase_requisition_category',50)->nullable();
            $table->string('purchase_requisition_type',50)->nullable();
            $table->string('requestor',50)->nullable();
            $table->string('created_by',50)->nullable();
            $table->dateTime('created_on')->nullable();   //duplicate field available in the timstamp command
            $table->string('changed_by',50)->nullable();
            $table->string('contract_number',50)->nullable();
            $table->string('contract_item_number',50)->nullable();
            $table->integer('item_no')->nullable();
            $table->string('item_description',255)->nullable();
            $table->string('material',191)->nullable();
            $table->string('item_text',191)->nullable();
            $table->string('item_category',191)->nullable();
            $table->integer('item_cost')->nullable();
            $table->integer('item_quantity')->nullable();
            $table->string('currency',50)->nullable();
            $table->string('purchase_order_indicator')->nullable();
            $table->integer('purchase_order_number')->nullable();
            $table->string('approved_indicator')->nullable();
            $table->string('status',50)->nullable();
            
           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('purchase_requisition', function (Blueprint $table) {
            Schema::dropIfExists('purchase_requisition');
        });
    }
}
