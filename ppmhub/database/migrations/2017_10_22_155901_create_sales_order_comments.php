<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrderComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_comments', function (Blueprint $table) {
            $table->increments('sales_order_comment_id');
            $table->integer('company_id');
            $table->integer('sales_order_id');
            $table->integer('user_id');
            $table->enum('user_type', ['approve', 'user']);
            $table->enum('type', ['order', 'quotation']);
            $table->string('description')->nullable();
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
        Schema::dropIfExists('sales_order_comments');
    }
}
