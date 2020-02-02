<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnSalesOrderTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('sales_order', function (Blueprint $table) {
            $table->renameColumn('quotation_profit_margin', 'salesorder_profit_margin');
            $table->renameColumn('quotation_profit_amt', 'salesorder_profit_amt');
            $table->renameColumn('quotation_profit_margin_grossprice', 'salesorder_profit_margin_grossprice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('sales_order', function (Blueprint $table) {
            $table->renameColumn('salesorder_profit_margin', 'quotation_profit_margin');
            $table->renameColumn('salesorder_profit_amt', 'quotation_profit_amt');
            $table->renameColumn('salesorder_profit_margin_grossprice', 'quotation_profit_margin_grossprice');
        });
    }

}
