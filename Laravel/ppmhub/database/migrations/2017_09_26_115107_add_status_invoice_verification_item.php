<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusInvoiceVerificationItem extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_verification_item', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->string('reversed')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_verification_item', function (Blueprint $table) {
             $table->dropColumn('status');
             $table->dropColumn('reversed');
        });
    }

}
