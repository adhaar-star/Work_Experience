<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnSalesOrderTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('sales_order', function (Blueprint $table) {
            $table->string('approved_indicator', 50)->nullable();
            $table->string('approver_token', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('sales_order', function (Blueprint $table) {
            $table->dropColumn('approved_indicator');
            $table->dropColumn('approver_token');
        });
    }

}
