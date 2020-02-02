<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnsSalespriceTable extends Migration
{

    public function up()
    {
        Schema::table('sales_pricing', function (Blueprint $table) {
        $table->dropIfExists('sales_pricing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_pricing', function (Blueprint $table) {
            Schema::dropIfExists('sales_pricing');
        });
    }

}
