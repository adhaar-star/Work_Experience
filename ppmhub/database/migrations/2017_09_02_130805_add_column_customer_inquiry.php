<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCustomerInquiry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->dropColumn('invoice_number');
            $table->dropColumn('inquiry_type');
            $table->dropColumn('customer');
            $table->dropColumn('sales_region');
            $table->dropColumn('req_delivery_date');
            $table->dropColumn('weight');
            $table->dropColumn('unit');
            $table->dropColumn('valid_from');
            $table->dropColumn('valid_to');
            $table->dropColumn('total_value');
            $table->dropColumn('net_amount');
            $table->dropColumn('item');
            $table->dropColumn('material_number');
            $table->dropColumn('order_qty');
            $table->dropColumn('customer_material_number');
            $table->dropColumn('cost_per_unit');
            $table->dropColumn('total_amount');
            $table->dropColumn('project_number');
            $table->dropColumn('task');
            $table->dropColumn('cost_center');
            $table->dropColumn('material_group');
            $table->dropColumn('reason_for_rejection');
            $table->dropColumn('requested_by');
            $table->dropColumn('company_name');
            $table->dropColumn('contact_personname');
            $table->dropColumn('contact_phone');

            $table->bigInteger('gross_price');
            $table->integer('discount');
            $table->integer('discount_amt');
            $table->bigInteger('discount_gross_price');
            $table->integer('sales_tax');
            $table->bigInteger('sales_taxamt');
            $table->bigInteger('net_price');
            $table->integer('freight_charges');
            $table->bigInteger('total_price');

            $table->date('changed_on');
            $table->integer('changed_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->string('invoice_number', 50)->nullable();
            $table->string('inquiry_type', 50)->nullable();
            $table->string('customer', 50)->nullable();
            $table->string('sales_region', 100)->nullable();
            $table->dateTime('req_delivery_date')->nullable();
            $table->integer('weight')->nullable();
            $table->string('unit', 20)->nullable();
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('valid_to')->nullable();
            $table->string('total_value', 20)->nullable();
            $table->string('net_amount', 20)->nullable();
            $table->string('item', 20)->nullable();
            $table->string('material_number')->nullable();
            $table->integer('order_qty')->nullable();
            $table->string('customer_material_number', 50)->nullable();
            $table->integer('cost_per_unit')->nullable();
            $table->integer('total_amount')->nullable();
            $table->string('project_number', 50)->nullable();
            $table->string('task')->nullable();
            $table->string('cost_center', 50)->nullable();
            $table->string('material_group', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('reason_for_rejection', 50)->nullable();
            $table->string('requested_by', 50)->nullable();
            $table->string('company_name', 100);
            $table->string('contact_personname', 100);
            $table->string('contact_phone');

            $table->dropColumn('gross_price');
            $table->dropColumn('discount');
            $table->dropColumn('discount_amt');
            $table->dropColumn('discount_gross_price');
            $table->dropColumn('sales_tax');
            $table->dropColumn('sales_taxamt');
            $table->dropColumn('net_price');
            $table->dropColumn('freight_charges');
            $table->dropColumn('total_price');
            
            $table->dropColumn('changed_on');
            $table->dropColumn('changed_by');
        });
    }
}
