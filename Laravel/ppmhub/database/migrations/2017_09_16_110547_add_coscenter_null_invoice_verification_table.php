<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoscenterNullInvoiceVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 
     */
      public function up()
    {
        Schema::table('invoice_verification_item', function (Blueprint $table) {
            $table->string('cost_center')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('invoice_verification_item', function (Blueprint $table) {
//            $table->dropColumn('cost_center');
//        });
    }
}
