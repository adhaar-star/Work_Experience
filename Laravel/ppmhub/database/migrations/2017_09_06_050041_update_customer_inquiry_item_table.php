<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCustomerInquiryItemTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->dropColumn('item_cost');
            $table->dropColumn('po_item');
            $table->integer('phaseid');
            $table->integer('customer');
            $table->string('company_name');
            $table->string('contact_person_name');
            $table->string('phone_no');
            $table->integer('inquiry_type');
            $table->string('short_description');
            $table->string('sales_region');
            $table->integer('weight');
            $table->integer('unit');
            $table->integer('invoice_number');
            $table->integer('requested_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->integer('item_cost')->nullable();
            $table->string('po_item')->nullable();
            $table->dropColumn('phaseid');
            $table->dropColumn('customer');
            $table->dropColumn('company_name');
            $table->dropColumn('contact_person_name');
            $table->dropColumn('phone_no');
            $table->dropColumn('inquiry_type');
            $table->dropColumn('short_description');
            $table->dropColumn('sales_region');
            $table->dropColumn('weight');
            $table->dropColumn('unit');
            $table->dropColumn('invoice_number');
            $table->dropColumn('requested_by');
        });
    }

}
