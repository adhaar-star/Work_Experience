<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnQuotationItemTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('quotation_item', function (Blueprint $table) {
            $table->integer('profit_margin')->nullable();
            $table->bigInteger('profit_amt')->nullable();
            $table->bigInteger('profit_gross_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('quotation_item', function (Blueprint $table) {
            $table->dropColumn('profit_margin');
            $table->dropColumn('profit_amt');
            $table->dropColumn('profit_gross_price');
        });
    }

}
