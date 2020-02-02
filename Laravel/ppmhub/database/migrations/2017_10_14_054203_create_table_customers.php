<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_customers', function (Blueprint $table) {

            $table->increments('customer_id')->unsigned();
            $table->integer('company_id');
            $table->integer('customer_no');
            $table->string('name');

            $table->string('email');
            $table->string('website_address')->nullable();
            $table->string('fax', 30)->nullable();

            $table->string('office_phone');

            $table->string('street');
            $table->string('city', 30);
            $table->string('postal_code', 20);
            $table->string('country', 20);
            $table->string('state', 30);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('master_customers');
    }
}
