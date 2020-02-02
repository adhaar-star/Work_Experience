<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostCentreCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_centre_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cost_centre')->nullable();
            $table->string('description')->nullable();
            $table->string('purchase_order_number')->nullable();
            $table->string('item_number')->nullable();
            $table->string('value')->nullable();
            $table->string('currency')->nullable();           
            $table->string('material_documber_number')->nullable();
            $table->string('posting_date')->nullable();
            $table->string('posted_by')->nullable();
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
        Schema::dropIfExists('cost_centre_cost');
    }
}
