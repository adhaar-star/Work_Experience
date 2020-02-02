<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnQuotationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('quotation', function (Blueprint $table) {
            $table->decimal('quotation_profit_margin', 5, 2)->nullable();
            $table->bigInteger('quotation_profit_amt')->nullable();
            $table->bigInteger('quotation_profit_margin_grossprice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('quotation', function (Blueprint $table) {
            $table->dropColumn('quotation_profit_margin');
            $table->dropColumn('quotation_profit_amt');
            $table->dropColumn('quotation_profit_margin_grossprice');
        });
    }

}
