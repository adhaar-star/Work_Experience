<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInquiry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('customer_inquiry', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('inquiry_number',50)->nullable();
            $table->string('inquiry_description',255)->nullable();
            $table->string('quotation',50)->nullable();
            $table->string('invoice_number',50)->nullable();
            $table->string('inquiry_type',50)->nullable();
            $table->string('customer',50)->nullable();
            $table->string('sales_region',100)->nullable();
            $table->string('purchase_order_number',20)->nullable();
            $table->dateTime('purchase_order_date')->nullable();
            $table->dateTime('req_delivery_date')->nullable();
            $table->integer('weight')->nullable();
            $table->string('unit',20)->nullable();
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('valid_to')->nullable();
            $table->string('inquiry_text',255)->nullable();
            $table->string('total_value',20)->nullable();
            $table->string('net_amount',20)->nullable();
            $table->string('item',20)->nullable();
            $table->string('material_number')->nullable();
            $table->integer('order_qty')->nullable();
            $table->string('customer_material_number',50)->nullable();
            $table->integer('cost_per_unit')->nullable();
            $table->integer('total_amount')->nullable();
            $table->string('po_item',50)->nullable();
            $table->string('project_number',50)->nullable();
            $table->string('task')->nullable();
            $table->string('cost_center',50)->nullable();
            $table->string('material_group',50)->nullable();
            $table->string('status',50)->nullable();
            $table->string('reason_for_rejection',50)->nullable();
            $table->dateTime('created_on',50)->nullable();
            $table->string('created_by',50)->nullable();
            $table->string('requested_by',50)->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('customer_inquiry');
    }
}
