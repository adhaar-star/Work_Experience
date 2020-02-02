<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerInquiryItemTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('customer_inquiry_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->nullable();
            $table->string('project_id')->nullable();
            $table->string('cost_center')->nullable();
            $table->bigInteger('tota_amt')->nullable();
            $table->integer('item_no')->nullable();          
            $table->string('material')->nullable();
            $table->string('customer_material_no')->nullable();
            $table->string('material_description')->nullable();
            $table->integer('item_quantity')->nullable();
            $table->string('cost_unit')->nullable();
            $table->integer('item_cost')->nullable();
            $table->integer('order_qty')->nullable();
            $table->string('task')->nullable();
            $table->string('material_group')->nullable();
            $table->string('reason')->nullable();         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('customer_inquiry_item');
    }

}
