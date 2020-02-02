<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSalesOrderTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('sales_order', function (Blueprint $table) {
            $table->dropColumn('purchase_order_number');
            $table->dropColumn('purchase_order_date');
            $table->dropColumn('req_delivery_date');
            $table->dropColumn('sales_order_value');
            $table->dropColumn('invoice_number');
            $table->dropColumn('weight');
            $table->dropColumn('unit');
            $table->dropColumn('valid_from');
            $table->dropColumn('valid_to');
            $table->dropColumn('total_value');
            $table->dropColumn('net_amount');
            $table->dropColumn('material_number');
            $table->dropColumn('order_qty');
            $table->dropColumn('customer_material_number');
            $table->dropColumn('pricing_date');
            $table->dropColumn('billing_block');
            $table->dropColumn('payment_terms');
            $table->dropColumn('ex_works');
            $table->dropColumn('cost_per_unit');
            $table->dropColumn('total_amount');
            $table->dropColumn('po_item');
            $table->dropColumn('project_number');
            $table->dropColumn('task');
            $table->dropColumn('cost_center');
            $table->dropColumn('material_group');
            $table->dropColumn('reason_for_rejection');
            $table->dropColumn('status');

            $table->renameColumn('sales_description', 'salesorder_description');
            $table->bigInteger('salesorder_number');
            $table->integer('company_id');
            $table->date('changed_on')->nullable();
            $table->integer('created_by')->change();
            $table->integer('changed_by')->nullable();
            $table->string('customer_name')->nullable();
            $table->integer('sales_organization')->nullable();
            $table->bigInteger('salesorder_gross_price')->nullable();
            $table->integer('salesorder_discount')->nullable();
            $table->integer('salesorder_discount_amt')->nullable();
            $table->bigInteger('salesorder_discount_gross_price')->nullable();
            $table->bigInteger('salesorder_sales_taxamt')->nullable();
            $table->bigInteger('salesorder_net_price')->nullable();
            $table->integer('salesorder_freight_charges')->nullable();
            $table->bigInteger('salesorder_total_price')->nullable();
            $table->decimal('quotation_profit_margin', 5, 2)->nullable();
            $table->bigInteger('quotation_profit_amt')->nullable();
            $table->bigInteger('quotation_profit_margin_grossprice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('sales_order', function (Blueprint $table) {
            $table->string('purchase_order_number', 50)->nullable();
            $table->date('purchase_order_date', 50)->nullable();
            $table->date('req_delivery_date', 50)->nullable();
            $table->string('sales_order_value', 50)->nullable();
            $table->string('invoice_number', 50)->nullable();
            $table->integer('weight')->nullable();
            $table->string('unit')->nullable();
            $table->date('valid_from', 50)->nullable();
            $table->date('valid_to', 50)->nullable();
            $table->string('total_value', 50)->nullable();
            $table->string('net_amount', 50)->nullable();
            $table->string('material_number')->nullable();
            $table->integer('order_qty')->nullable();
            $table->string('customer_material_number', 50)->nullable();
            $table->date('pricing_date')->nullable();
            $table->string('billing_block')->nullable();
            $table->string('payment_terms', 50)->nullable();
            $table->string('ex_works', 50)->nullable();
            $table->integer('cost_per_unit')->nullable();
            $table->integer('total_amount')->nullable();
            $table->string('po_item', 50)->nullable();
            $table->string('project_number', 50)->nullable();
            $table->string('task', 50)->nullable();
            $table->string('cost_center', 100)->nullable();
            $table->string('material_group', 20)->nullable();
            $table->string('reason_for_rejection', 50)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('created_by',50)->change();

            $table->renameColumn('salesorder_description', 'sales_description');
            $table->dropColumn('salesorder_number');
            $table->dropColumn('company_id');
            $table->dropColumn('changed_on')->nullable();
            $table->dropColumn('changed_by')->nullable();
            $table->dropColumn('customer_name')->nullable();
            $table->dropColumn('sales_organization')->nullable();
            $table->dropColumn('salesorder_gross_price')->nullable();
            $table->dropColumn('salesorder_discount')->nullable();
            $table->dropColumn('salesorder_discount_amt')->nullable();
            $table->dropColumn('salesorder_discount_gross_price')->nullable();
            $table->dropColumn('salesorder_sales_taxamt')->nullable();
            $table->dropColumn('salesorder_net_price')->nullable();
            $table->dropColumn('salesorder_freight_charges')->nullable();
            $table->dropColumn('salesorder_total_price')->nullable();
            $table->dropColumn('quotation_profit_margin', 5, 2)->nullable();
            $table->dropColumn('quotation_profit_amt')->nullable();
            $table->dropColumn('quotation_profit_margin_grossprice')->nullable();
        });
    }

}
