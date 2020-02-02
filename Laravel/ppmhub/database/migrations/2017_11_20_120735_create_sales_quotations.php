<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesQuotations extends Migration
{

    public function up()
    {
        Schema::create('sales_quotations', function (Blueprint $table) {

            $table->increments('sales_quotation_id');
            $table->integer('company_id');
            $table->integer('sales_quotation_no');
            $table->integer('customer');
            $table->integer('sales_inquiry_id')->nullable();
            $table->integer('sales_order_id')->nullable();

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

            $table->integer('approver_1');
            $table->integer('approver_2')->nullable();
            $table->integer('approver_3')->nullable();
            $table->integer('approver_4')->nullable();
            $table->integer('approve_status')->default(0)->nullable();

            $table->string('description')->nullable();
            $table->string('subject')->nullable();
            $table->text('message')->nullable();


            $table->enum( 'status', [ 'created', 'pending', 'submitted', 'approved', 'success' ] );
            $table->enum( 'sales_order_type', [ 'service', 'goods', 'milestone', 'timesheet' ]);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_quotations');
    }
}
