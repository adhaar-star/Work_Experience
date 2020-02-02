<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequisitionNewTable extends Migration
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
            $table->string('header_note',255)->nullable();
            $table->string('status',50)->nullable();
            $table->integer('item_no')->nullable();
            $table->string('item_category',191)->nullable();
            $table->string('material',191)->nullable();
            $table->string('material_description',255)->nullable();    
            $table->integer('item_quantity')->nullable();
            $table->string('quantity_unit')->nullable();
            $table->integer('item_cost')->nullable();
            $table->string('currency',50)->nullable();
            $table->dateTime('delivery_date',50)->nullable();
            $table->string('material_group',50)->nullable();
            $table->string('vendor',50)->nullable();
            $table->string('requestor',50)->nullable();
            $table->string('contract_number',50)->nullable();
            $table->string('contract_item_number',50)->nullable();
            $table->integer('purchase_order_number')->nullable();
            $table->string('project_id',255)->nullable();
            $table->string('phase_id',255)->nullable();
            $table->string('task_id',255)->nullable();
            $table->string('g_l_account',255)->nullable();
            $table->string('cost_center',255)->nullable();
            $table->string('created_by',50)->nullable();
            $table->dateTime('created_on')->nullable();   //duplicate field available in the timstamp command
            $table->string('changed_by',50)->nullable();
            $table->string('approver_1',50)->nullable();
            $table->string('approver_2',50)->nullable();
            $table->string('approver_3',50)->nullable();
            $table->string('approver_4',50)->nullable();
            $table->string('approved_indicator',50)->nullable();
            $table->string('processing_status',50)->nullable();
            
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
