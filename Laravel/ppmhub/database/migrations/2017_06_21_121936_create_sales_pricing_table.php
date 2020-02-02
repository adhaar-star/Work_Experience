<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesPricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('sales_pricing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sales_orderno')->nullable();
            $table->string('item_no')->nullable();
            $table->integer('base_price')->nullable();
            $table->string('gross_value')->nullable();
            $table->string('discount')->nullable();
            $table->string('net_value')->nullable();
            $table->string('down_payment')->nullable();
            $table->date('output_tax')->nullable();
            $table->integer('freight')->nullable();    
            $table->string('total')->nullable();
            $table->string('g/l_account_base')->nullable();
            $table->string('g/l_account_tax')->nullable();
            $table->string('g/l_account_freight')->nullable();
            $table->string('g/l_account_down')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('sales_pricing');
    }
}
