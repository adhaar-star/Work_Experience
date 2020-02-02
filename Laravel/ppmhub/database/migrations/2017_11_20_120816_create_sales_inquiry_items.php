<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInquiryItems extends Migration
{
    public function up()
    {
        Schema::create('sales_inquiry_items', function (Blueprint $table) {

            $table->increments('sales_inquiry_item_id');
            $table->integer('company_id');
            $table->integer('sales_inquiry_id');
            $table->integer('sales_inquiry_item_no');

            $table->integer('project_id');
            $table->integer('task_id')->nullable();
            $table->integer('phase_id')->nullable();
            $table->integer('cost_center_id');

            $table->integer('material')->nullable();
            $table->integer('material_no')->nullable();
            $table->integer('material_quantity')->nullable();

            $table->decimal('unit_price');
            $table->decimal('gross_price');
            $table->decimal('discount')->default(0.00);
            $table->decimal('discount_amount')->default(0.00);
            $table->decimal('tax')->default(0.00);
            $table->decimal('tax_amount')->default(0.00);
            $table->decimal('profit_margin')->default(0.00);
            $table->decimal('profit_margin_amount')->default(0.00);
            $table->decimal('freight_charges')->default(0.00);
            $table->decimal('total_price');

            $table->string('company_name');
            $table->string('company_contact_person')->nullable();
            $table->string('company_contact_phone')->nullable();

            $table->string('description')->nullable();
            $table->string('delivery_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales_inquiry_items');
    }
}
