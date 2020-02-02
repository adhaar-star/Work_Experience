<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnSalesOrder extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('sales_order', function (Blueprint $table) {
            $table->string('approver_1')->nullable();
            $table->string('approver_2')->nullable();
            $table->string('approver_3')->nullable();
            $table->string('approver_4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('sales_order', function (Blueprint $table) {
            $table->dropColumn('approver_1');
            $table->dropColumn('approver_2');
            $table->dropColumn('approver_3');
            $table->dropColumn('approver_4');
        });
    }

}
