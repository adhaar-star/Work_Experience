<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name',50)->nullable();
            $table->string('vendor_id',50)->nullable();
            $table->string('website_address',50)->nullable();
            $table->string('office_phone',15)->nullable();
            $table->string('fax',50)->nullable();
            $table->string('street',50)->nullable();
            $table->string('city',80)->nullable();
            $table->string('state',100)->nullable();
            $table->string('postal_code',20)->nullable();
            $table->string('country',100)->nullable();
            $table->string('email',50)->nullable();
            $table->string('tax_no',20)->nullable();
            $table->string('onetime_vendor',20)->nullable();
            $table->string('approved_vendor',20)->nullable();
            $table->string('category',50)->nullable();
            $table->string('payment_terms',50)->nullable();
            $table->string('abn_no',20)->nullable();
            $table->string('acn_no',20)->nullable();
            $table->string('e_invoice',20)->nullable();
            $table->string('bank_name',100)->nullable();
            $table->string('bsb',50)->nullable();
            $table->string('account_no',50)->nullable();
            $table->string('ifsc_code',50)->nullable();
            $table->string('contact_role',20)->nullable();
            $table->string('status',10)->nullable();
            $table->string('contact_name',50)->nullable();
            $table->bigInteger('contact_phone')->nullable();
            $table->string('contact_email',50)->nullable();
            $table->timestamps();
           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendor');
    }
}
