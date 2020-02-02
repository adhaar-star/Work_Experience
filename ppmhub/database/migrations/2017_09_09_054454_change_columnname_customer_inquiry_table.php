<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnnameCustomerInquiryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->renameColumn('gross_price', 'inquiry_gross_price');
            $table->renameColumn('discount', 'inquiry_discount');
            $table->renameColumn('discount_amt', 'inquiry_discount_amt');
            $table->renameColumn('discount_gross_price', 'inquiry_discount_gross_price');
            $table->renameColumn('sales_tax', 'inquiry_sales_tax');
            $table->renameColumn('sales_taxamt', 'inquiry_sales_taxamt');
            $table->renameColumn('net_price', 'inquiry_net_price');
            $table->renameColumn('freight_charges', 'inquiry_freight_charges');
            $table->renameColumn('total_price', 'inquiry_total_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
            Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->renameColumn('inquiry_gross_price', 'gross_price');
            $table->renameColumn('inquiry_discount', 'discount');
            $table->renameColumn('inquiry_discount_amt', 'discount_amt');
            $table->renameColumn('inquiry_discount_gross_price', 'discount_gross_price');
            $table->renameColumn('inquiry_sales_tax', 'sales_tax');
            $table->renameColumn('inquiry_sales_taxamt', 'sales_taxamt');
            $table->renameColumn('inquiry_net_price', 'net_price');
            $table->renameColumn('inquiry_freight_charges', 'freight_charges');
            $table->renameColumn('inquiry_total_price', 'total_price');
        });
    }

}
