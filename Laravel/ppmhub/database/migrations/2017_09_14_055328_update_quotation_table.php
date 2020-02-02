<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateQuotationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('quotation', function (Blueprint $table) {
            $table->dropColumn('quotation_short_description');
            $table->dropColumn('purchase_order_number');
            $table->dropColumn('purchase_order_date');
            $table->dropColumn('req_delivery_date');
            $table->dropColumn('invoice_number');
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
            $table->dropColumn('po_item');
            $table->dropColumn('project_number');
            $table->dropColumn('task');
            $table->dropColumn('cost_center');
            $table->dropColumn('material_group');
            $table->dropColumn('reason_for_rejection');
            $table->dropColumn('status');
         
            $table->string('quotation_description', 250)->nullable();
            $table->integer('company_id');
            $table->date('created_on')->change();
            $table->date('changed_on')->nullable();
            $table->integer('created_by')->change();
            $table->integer('changed_by')->nullable();
            $table->string('customer_name')->nullable();
            $table->integer('sales_organization')->nullable();
            $table->bigInteger('quotation_gross_price')->nullable();
            $table->integer('quotation_discount')->nullable();
            $table->integer('quotation_discount_amt')->nullable();
            $table->bigInteger('quotation_discount_gross_price')->nullable();
            $table->bigInteger('quotation_sales_taxamt')->nullable();
            $table->bigInteger('quotation_net_price')->nullable();
            $table->integer('quotation_freight_charges')->nullable();
            $table->bigInteger('quotation_total_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('quotation', function (Blueprint $table) {
            $table->string('quotation_short_description', 255)->nullable();
            $table->string('purchase_order_number', 50)->nullable();
            $table->date('purchase_order_date', 50)->nullable();
            $table->date('req_delivery_date', 50)->nullable();
            $table->string('invoice_number', 50)->nullable();
            $table->integer('weight')->nullable();
            $table->string('unit')->nullable();
            $table->date('valid_from', 50)->nullable();
            $table->date('valid_to', 50)->nullable();
            $table->integer('total_value')->nullable();
            $table->string('net_amount', 50)->nullable();
            $table->string('item', 50)->nullable();
            $table->string('material_number')->nullable();
            $table->integer('order_qty')->nullable();
            $table->string('customer_material_number', 50)->nullable();
            $table->integer('cost_per_unit')->nullable();
            $table->integer('total_amount')->nullable();
            $table->string('po_item', 50)->nullable();
            $table->string('project_number', 50)->nullable();
            $table->string('task', 50)->nullable();
            $table->string('cost_center', 50)->nullable();
            $table->string('material_group', 50)->nullable();
            $table->string('reason_for_rejection', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('created_on', 50)->nullable();
            $table->string('created_by', 100)->nullable();

            $table->dropColumn('quotation_description');
            $table->dropColumn('company_id');
            $table->dropColumn('created_on');
            $table->dropColumn('changed_on');
            $table->dropColumn('created_by');
            $table->dropColumn('changed_by');
            $table->dropColumn('customer_name');
            $table->dropColumn('sales_organization');
            $table->dropColumn('quotation_gross_price');
            $table->dropColumn('quotation_discount');
            $table->dropColumn('quotation_discount_amt');
            $table->dropColumn('quotation_discount_gross_price');
            $table->dropColumn('quotation_sales_taxamt');
            $table->dropColumn('quotation_net_price');
            $table->dropColumn('quotation_freight_charges');
            $table->dropColumn('quotation_total_price');
        });
    }

}
