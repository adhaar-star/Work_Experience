<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnCustomerInquiryItemTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->dropColumn('item_quantity');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('customer');
            $table->dropColumn('inquiry_type');
            $table->dropColumn('sales_region');
            $table->dropColumn('requested_by');

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
        Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->integer('item_quantity')->nullable();
            $table->timestamps();
            $table->integer('customer')->nullable();
            $table->integer('inquiry_type')->nullable();
            $table->string('sales_region')->nullable();
            $table->integer('requested_by')->nullable();

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
        });
    }

}
