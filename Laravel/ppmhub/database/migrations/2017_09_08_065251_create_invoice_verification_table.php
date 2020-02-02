<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceVerificationTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_verification', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('posting_date')->nullable();
            $table->string('vendor')->nullable();
            $table->string('po_order_number')->nullable();
            $table->string('reversed')->nullable();
            $table->string('posted_status')->nullable();
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
        Schema::dropIfExists('invoice_verification');
    }

}
