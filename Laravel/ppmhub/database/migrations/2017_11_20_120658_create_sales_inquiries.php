<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInquiries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_inquiries', function (Blueprint $table) {

            $table->increments('sales_inquiry_id');
            $table->integer('company_id');
            $table->integer('sales_inquiry_no');
            $table->integer('customer');

            $table->integer('sales_quotation_id')->nullable();

            $table->integer('region')->nullable();
            $table->integer('organization')->nullable();
            $table->integer('requested_by')->nullable();

            $table->decimal('down_payment')->default(0.00);
            $table->decimal('gross_price')->default(0.00);
            $table->decimal('discount_amount')->default(0.00);
            $table->decimal('tax_amount')->default(0.00);
            $table->decimal('profit_margin_amount')->default(0.00);
            $table->decimal('freight_charges')->default(0.00);
            $table->decimal('total_price')->default(0.00);

            $table->string('description')->nullable();
            $table->enum('status', [ 'created', 'success' ]);
            $table->enum('sales_order_type', [ 'service', 'goods', 'milestone', 'timesheet' ]);
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
        Schema::dropIfExists('sales_inquiries');
    }
}
