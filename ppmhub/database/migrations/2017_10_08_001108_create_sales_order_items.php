<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_items', function (Blueprint $table) {

            $table->increments('sales_order_item_id');
            $table->integer('company_id');
            $table->integer('sales_order_id');
            $table->integer('sales_order_item_no');

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

            $table->string('incoterms')->nullable();
            $table->boolean('auto_billing')->nullable();
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
        Schema::dropIfExists('sales_order_items');
    }
}
