<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGlaccountpaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('glaccount_payment', function (Blueprint $table) {
           
              $table->bigInteger('glaccount_payment')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('glaccount_payment', function (Blueprint $table) {
           
              $table->integer('glaccount_payment')->change();
        });
    }
}
