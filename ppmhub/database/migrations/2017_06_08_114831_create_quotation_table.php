<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('quotation', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('quotation_number')->nullable();
            $table->string('quotation_type',100)->nullable();
            $table->string('quotation_short_description',255)->nullable();
            $table->string('customer',50)->nullable();
            $table->string('inquiry',50)->nullable();
            $table->string('sales_order',50)->nullable();
            $table->string('sales_region',50)->nullable();
            $table->string('purchase_order_number',50)->nullable();
            $table->date('purchase_order_date',50)->nullable();
            $table->date('req_delivery_date',50)->nullable();
            $table->string('invoice_number',50)->nullable();
            $table->integer('weight')->nullable();
            $table->string('unit')->nullable();
            $table->date('valid_from',50)->nullable();
            $table->date('valid_to',50)->nullable();
            $table->integer('total_value')->nullable();
            $table->string('net_amount',50)->nullable();
            $table->string('item',50)->nullable();
            $table->string('material_number')->nullable();
            $table->integer('order_qty')->nullable();
            $table->string('customer_material_number',50)->nullable();
            $table->integer('cost_per_unit')->nullable();
            $table->integer('total_amount')->nullable();
            $table->string('po_item',50)->nullable();
            $table->string('project_number',50)->nullable();
            $table->string('task',50)->nullable();
            $table->string('cost_center',50)->nullable();
            $table->string('material_group',50)->nullable();
            $table->string('reason_for_rejection',50)->nullable();
            $table->string('created_on',50)->nullable();
            $table->string('created_by',100)->nullable();
            $table->string('requested_by',20)->nullable();
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
        Schema::dropIfExists('quotation');
    }
    }

