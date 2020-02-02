<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerMaster extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('customer_master', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 50)->nullable();
            $table->string('customer_id')->nullable();
            $table->string('website_address')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('email')->nullable();
            $table->string('tax_no')->nullable();
            $table->string('onetime_customer')->nullable();
            $table->string('approved_customer')->nullable();
            $table->string('category')->nullable();
            $table->string('payment_terms')->nullable();
            $table->string('abn_no')->nullable();
            $table->string('acn_no')->nullable();
            $table->string('e_invoice')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bsb')->nullable();
            $table->string('account_no')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('status')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_role')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('customer_master');
    }

}
