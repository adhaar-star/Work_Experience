<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeGoodsReceiptTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_receipt', function (Blueprint $table) {

            $table->date('posting_date')->change();
            $table->date('document_date')->change();
            $table->date('created_on')->change();
            $table->date('changed_on')->change();
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

            $table->string('document_date')->change();
            $table->string('posting_date')->change();
            $table->string('created_on')->change();
            $table->string('changed_on')->change();
        });
    }

}
