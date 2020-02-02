<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnCustomerInquiryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->integer('company_id');
            $table->string('processing_status', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->string('status', 50)->nullable();
        });

        Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->dropColumn('processing_status');
        });
    }

}
