<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceVerificationItemTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_verification_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchase_order_item_no')->nullable();
            $table->string('item_description')->nullable();
            $table->string('goods_receipt_indicator')->nullable();
            $table->string('po_order_number')->nullable();
            $table->string('po_order_value')->nullable();
            $table->string('po_order_qty')->nullable();
            $table->string('qty_recevied')->nullable();
            $table->string('g_r_amount')->nullable();
            $table->string('invoice_value')->nullable();
            $table->string('difference')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('g_l_account')->nullable();
            $table->string('project_id')->nullable();
            $table->string('phase_id')->nullable();
            $table->string('task_id')->nullable();

            $table->string('invoice_id')->nullable();
            $table->string('posted_status')->nullable();
            $table->string('currency')->nullable();


            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('changed_by')->nullable();
            $table->integer('company_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_verification_item');
    }

}
