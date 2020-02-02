<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnCustomerInquiry extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->dropColumn('purchase_order_number');
            $table->dropColumn('purchase_order_date');
            $table->string('company_name', 100);
            $table->string('contact_personname', 100);
            $table->string('contact_phone');
            $table->dropColumn('po_item');
            $table->dropColumn('inquiry_text');
            $table->string('inquiry_description', 40)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->string('purchase_order_number', 20)->nullable();
            $table->dateTime('purchase_order_date')->nullable();
            $table->dropColumn('company_name');
            $table->dropColumn('contact_personname');
            $table->dropColumn('contact_phone');
            $table->string('po_item', 50)->nullable();
            $table->string('inquiry_text', 255)->nullable();
            $table->string('inquiry_description', 255)->change();
        });
    }

}
