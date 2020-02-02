<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnGoodsReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_receipt', function (Blueprint $table) {
          
          $table->string('material_no');
          $table->dropColumn('created_at');
          $table->dropColumn('updated_at');

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
          
          $table->dropColumn('material_no');
          $table->timestamps();

        });
    }
}
