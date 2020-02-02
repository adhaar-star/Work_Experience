<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumntypeIncustomerInquiryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->decimal('inquiry_discount', 3, 2)->change();
            $table->dropColumn('inquiry_sales_tax');
        });

        Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->dropColumn('weight');
            $table->dropColumn('unit');
            $table->dropColumn('invoice_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->integer('inquiry_discount')->change();
            $table->integer('inquiry_sales_tax');
        });

        Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->integer('weight');
            $table->integer('unit');
            $table->integer('invoice_number');
        });
    }

}
