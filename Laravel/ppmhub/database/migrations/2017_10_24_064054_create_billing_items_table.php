<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_items', function (Blueprint $table) {
            $table->increments('billing_item_id');
            $table->integer('billing_id');
            $table->integer('sales_order_item_id');
            $table->integer('sales_order_id');
            $table->tinyInteger('milestone')->default(100);

            $table->decimal('gross_price')->default(0.00);
            $table->decimal('discount_amount')->default(0.00);
            $table->decimal('tax_amount')->default(0.00);
            $table->decimal('freight_charges')->default(0.00);
            $table->decimal('total_price')->default(0.00);

            $table->text('description')->nullable();
            $table->enum('sales_order_type', [ 'service', 'goods', 'milestone', 'timesheet' ] );
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
        Schema::dropIfExists('billing_items');
    }
}
