<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsPayableTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_payable', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_id', 255)->nullable();
            $table->string('account_name', 255)->nullable();
            $table->string('Reference', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->integer('credit')->nullable();
            $table->integer('debit')->nullable();
            $table->integer('value')->nullable();
            $table->string('company_id');
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
        Schema::dropIfExists('accounts_payable');
    }

}
