<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangetypeCustomerInquiryItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->integer('phaseid')->nullable()->change();
            $table->integer('customer')->nullable()->change();
            $table->string('company_name')->nullable()->change();
            $table->string('contact_person_name')->nullable()->change();
            $table->string('phone_no')->nullable()->change();
            $table->integer('inquiry_type')->nullable()->change();
            $table->string('short_description')->nullable()->change();
            $table->string('sales_region')->nullable()->change();
            $table->integer('weight')->nullable()->change();
            $table->integer('unit')->nullable()->change();
            $table->integer('invoice_number')->nullable()->change();
            $table->integer('requested_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->integer('phaseid')->change();
            $table->integer('customer')->change();
            $table->string('company_name')->change();
            $table->string('contact_person_name')->change();
            $table->string('phone_no')->change();
            $table->integer('inquiry_type')->change();
            $table->string('short_description')->change();
            $table->string('sales_region')->change();
            $table->integer('weight')->change();
            $table->integer('unit')->change();
            $table->integer('invoice_number')->change();
            $table->integer('requested_by')->change();
        });
    }
}
