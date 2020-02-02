<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {

            $table->increments('sales_order_id');
            $table->integer('company_id');
            $table->integer('sales_order_no');
            $table->integer('customer');

            $table->integer('region')->nullable();
            $table->integer('inquiry')->nullable();
            $table->integer('quotation')->nullable();
            $table->integer('organization')->nullable();
            $table->integer('requested_by')->nullable();

            $table->decimal('gross_price')->default(0.00);
            $table->decimal('discount_amount')->default(0.00);
            $table->decimal('tax_amount')->default(0.00);
            $table->decimal('profit_margin_amount')->default(0.00);
            $table->decimal('freight_charges')->default(0.00);
            $table->decimal('total_price')->default(0.00);

            $table->integer('approver_1');
            $table->integer('approver_2')->nullable();
            $table->integer('approver_3')->nullable();
            $table->integer('approver_4')->nullable();

            $table->integer('total_recurring_period')->nullable();
            $table->integer('recurring_period')->nullable();
            $table->integer('auto_billing')->nullable();
            $table->date('auto_billing_date')->nullable();

            $table->string('description')->nullable();
            $table->enum('sales_order_type', ['service', 'goods', 'milestone', 'timesheet' ]);
            $table->enum('sales_order_status', ['created', 'pending', 'approved', 'success', 'billed' ])->default('created');
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
        Schema::dropIfExists('sales_orders');
    }
}