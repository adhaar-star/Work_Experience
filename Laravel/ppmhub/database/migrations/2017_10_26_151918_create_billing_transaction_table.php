<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_transactions', function (Blueprint $table) {
            $table->increments('billing_transaction_id');
            $table->integer('billing_no');
            $table->integer('billing_id');
            $table->integer('company_id');
            $table->integer('sales_order_id');
            $table->integer('sales_order_no');
            $table->integer('customer_id');

            $table->decimal('gross_price')->default(0.00)->nullable();
            $table->enum('gross_price_indicator', ['credit', 'debit'])->nullable();
            $table->string('gross_price_flag', 10)->nullable();
            $table->integer('gross_price_gl_account_id')->nullable();


            $table->decimal('inventory')->default(0.00)->nullable();
            $table->enum('inventory_indicator', ['credit', 'debit'])->nullable();
            $table->string('inventory_flag', 10)->nullable();
            $table->integer('inventory_flag_gl_account_id')->nullable();

            $table->decimal('revenue')->default(0.00);
            $table->enum('revenue_indicator', ['credit', 'debit']);
            $table->string('revenue_flag', 10)->nullable();
            $table->integer('revenue_flag_gl_account_id')->nullable();

            $table->decimal('gst')->default(0.00);
            $table->enum('gst_indicator', ['credit', 'debit']);
            $table->string('gst_flag', 10)->nullable();
            $table->integer('gst_flag_gl_account_id')->nullable();

            $table->decimal('freight')->default(0.00);
            $table->enum('freight_indicator', ['credit', 'debit']);
            $table->string('freight_flag', 10)->nullable();
            $table->integer('freight_flag_gl_account_id')->nullable();

            $table->decimal('accounts_receivable')->default(0.00);
            $table->enum('accounts_receivable_indicator', ['credit', 'debit']);
            $table->string('accounts_flag', 10)->nullable();
            $table->integer('accounts_flag_gl_account_id')->nullable();

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
        Schema::dropIfExists('billing_transactions');
    }
}
