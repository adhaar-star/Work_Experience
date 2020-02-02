<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSalesOrderItemTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('sales_item', function (Blueprint $table) {
            $table->dropColumn('item');
            $table->dropColumn('sales_orderno');
            $table->dropColumn('material_number');
            $table->dropColumn('first_delivery_date');
            $table->dropColumn('net_value');
            $table->dropColumn('currency');
            $table->dropColumn('pricing_date');
            $table->dropColumn('usage');
            $table->dropColumn('unloading_point');
            $table->dropColumn('shipping_point');
            $table->dropColumn('gross_weight');
            $table->dropColumn('weight_unit');
            $table->dropColumn('net_weight');
            $table->dropColumn('volume');
            $table->dropColumn('volume_unit');
            $table->dropColumn('billing_block');

            $table->string('salesorder_number')->nullable();
            $table->string('status')->nullable();
            $table->string('project_id')->nullable();
            $table->string('cost_center')->nullable();
            $table->bigInteger('tota_amt')->nullable();
            $table->integer('item_no')->nullable();
            $table->string('material')->nullable();
            $table->string('customer_material_no')->nullable();
            $table->string('cost_unit')->nullable();
            $table->integer('order_qty')->change();
            $table->string('task')->nullable();
            $table->string('material_group')->nullable();
            $table->string('reason')->nullable();
            $table->integer('phaseid')->nullable();
            $table->string('company_name')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('short_description', 40)->nullable();
            $table->integer('company_id');
            $table->string('processing_status', 50)->nullable();
            $table->bigInteger('gross_price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('discount_amt')->nullable();
            $table->bigInteger('discount_gross_price')->nullable();
            $table->integer('sales_tax')->nullable();
            $table->bigInteger('sales_taxamt')->nullable();
            $table->bigInteger('net_price')->nullable();
            $table->integer('freight_charges')->nullable();
            $table->bigInteger('total_price')->nullable();

            $table->date('created_on')->nullable();
            $table->date('changed_on')->nullable();
            $table->integer('changed_by')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('profit_margin')->nullable();
            $table->bigInteger('profit_amt')->nullable();
            $table->bigInteger('profit_gross_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::create('sales_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item')->nullable();
            $table->string('sales_orderno')->nullable();
            $table->string('material_number')->nullable();
            $table->string('order_qty')->nullable();
            $table->string('material_description')->nullable();
            $table->date('first_delivery_date')->nullable();
            $table->integer('net_value')->nullable();
            $table->string('currency')->nullable();
            $table->date('pricing_date')->nullable();
            $table->string('usage')->nullable();
            $table->string('unloading_point')->nullable();
            $table->string('shipping_point')->nullable();
            $table->string('gross_weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->string('net_weight')->nullable();
            $table->string('volume')->nullable();
            $table->string('volume_unit')->nullable();
            $table->string('billing_block')->nullable();

            $table->dropColumn('salesorder_number')->nullable();
            $table->dropColumn('status');
            $table->dropColumn('project_id');
            $table->dropColumn('cost_center');
            $table->dropColumn('tota_amt');
            $table->dropColumn('item_no');
            $table->dropColumn('material');
            $table->dropColumn('customer_material_no');
            $table->dropColumn('material_description');
            $table->dropColumn('cost_unit');
            $table->dropColumn('order_qty');
            $table->dropColumn('task');
            $table->dropColumn('material_group');
            $table->dropColumn('reason');
            $table->dropColumn('phaseid');
            $table->dropColumn('company_name');
            $table->dropColumn('contact_person_name');
            $table->dropColumn('phone_no');
            $table->dropColumn('short_description');
            $table->dropColumn('company_id');
            $table->dropColumn('processing_status');
            $table->dropColumn('gross_price');
            $table->dropColumn('discount');
            $table->dropColumn('discount_amt');
            $table->dropColumn('discount_gross_price');
            $table->dropColumn('sales_tax');
            $table->dropColumn('sales_taxamt');
            $table->dropColumn('net_price');
            $table->dropColumn('freight_charges');
            $table->dropColumn('total_price');

            $table->dropColumn('created_on');
            $table->dropColumn('changed_on');
            $table->dropColumn('changed_by');
            $table->dropColumn('created_by');
            $table->dropColumn('profit_margin');
            $table->dropColumn('profit_amt');
            $table->dropColumn('profit_gross_price');
        });
    }

}
