<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractItemTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 50)->nullable();
            $table->string('purchase_orderno', 255)->nullable();
            $table->integer('item_no')->nullable();
            $table->string('item_category', 191)->nullable();
            $table->string('material', 191)->nullable();
            $table->string('material_description', 255)->nullable();
            $table->integer('item_quantity')->nullable();
            $table->string('quantity_unit')->nullable();
            $table->integer('item_cost')->nullable();
            $table->string('currency', 50)->nullable();
            $table->string('material_group', 50)->nullable();
            $table->string('vendor', 50)->nullable();
            $table->string('requestor', 50)->nullable();
            $table->string('aggreement_number', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_item', function (Blueprint $table) {
            Schema::dropIfExists('contract_item');
        });
    }

}
