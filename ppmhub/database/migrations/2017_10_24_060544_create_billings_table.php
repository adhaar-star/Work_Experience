<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('billing_id');
            $table->integer('billing_no');
            $table->integer('company_id');
            $table->integer('sales_order_id');
            $table->integer('sales_order_no');
            $table->integer('customer_id');

            $table->decimal('gross_price')->default(0.00);
            $table->decimal('discount_amount')->default(0.00);
            $table->decimal('tax_amount')->default(0.00);
            $table->decimal('freight_charges')->default(0.00);

            $table->decimal('down_payment')->default(0.00);
            $table->decimal('total_payable')->default(0.00);
            $table->date('due_payment_date');

            $table->enum( 'billing_type', [ 'service', 'goods', 'milestone', 'timesheet' ] );
            $table->enum( 'billing_status', [ 'created', 'success' ] )->default('created');
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
        Schema::dropIfExists('billings');
    }
}
