<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationItemTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('quotation_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quotation_number')->nullable();
            $table->string('status')->nullable();
            $table->string('project_id')->nullable();
            $table->string('cost_center')->nullable();
            $table->bigInteger('tota_amt')->nullable();
            $table->integer('item_no')->nullable();
            $table->string('material')->nullable();
            $table->string('customer_material_no')->nullable();
            $table->string('material_description')->nullable();
            $table->string('cost_unit')->nullable();
            $table->integer('order_qty')->nullable();
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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('quotation_item');
    }

}
