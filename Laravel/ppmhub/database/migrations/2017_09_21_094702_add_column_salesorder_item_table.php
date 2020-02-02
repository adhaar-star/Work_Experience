<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSalesorderItemTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('sales_item', function (Blueprint $table) {
            $table->string('incoterms', 250)->nullable();
            $table->date('invoicing_dates')->nullable();
            $table->string('milestone', 250)->nullable();
            $table->string('billing_block', 250)->nullable();
            $table->string('auto_billing', 250)->nullable();
            $table->string('billing_reminder', 250)->nullable();
            $table->string('payment_card', 250)->nullable();
            $table->string('paypal', 250)->nullable();
            $table->string('down_payment', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('sales_item', function (Blueprint $table) {
            $table->dropColumn('incoterms');
            $table->dropColumn('invoicing_dates');
            $table->dropColumn('milestone');
            $table->dropColumn('billing_block');
            $table->dropColumn('auto_billing');
            $table->dropColumn('billing_reminder');
            $table->dropColumn('payment_card');
            $table->dropColumn('paypal');
            $table->dropColumn('down_payment');
        });
    }

}
