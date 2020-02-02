<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnCustomerInquiryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->integer('customer')->nullable();
            $table->string('customer_name')->nullable();
            $table->integer('sales_organization')->nullable();
            $table->integer('sales_region')->nullable();
            $table->string('inquiry_type')->nullable();
            $table->string('requested_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->dropColumn('customer');
            $table->dropColumn('customer_name');
            $table->dropColumn('sales_organization');
            $table->dropColumn('sales_region');
            $table->dropColumn('inquiry_type');
            $table->dropColumn('requested_by');
        });
    }

}
