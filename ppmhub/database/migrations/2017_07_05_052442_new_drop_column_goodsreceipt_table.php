<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewDropColumnGoodsreceiptTable extends Migration
{

    public function up()
    {
        Schema::table('goods_receipt', function (Blueprint $table) {
            Schema::dropIfExists('goods_receipt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_receipt', function (Blueprint $table) {
            Schema::dropIfExists('goods_receipt');
        });
    }

}
