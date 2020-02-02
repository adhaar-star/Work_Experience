<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewCreateGoodsreceiptTable extends Migration
{

    public function up()
    {
        Schema::create('goods_receipt', function (Blueprint $table) {
            $table->increments('id');
            $table->string('purchase_order_number')->nullable();
            $table->string('document_date')->nullable();
            $table->string('posting_date')->nullable();
            $table->string('created_by')->nullable();
            $table->string('created_on')->nullable();
            $table->string('changed_by')->nullable();
            $table->string('changed_on')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('goods_receipt');
    }

}
