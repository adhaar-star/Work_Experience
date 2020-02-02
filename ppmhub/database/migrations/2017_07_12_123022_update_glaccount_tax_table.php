<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateGlaccountTaxTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('glaccount_tax', function (Blueprint $table) {
            $table->bigInteger('glaccount_tax')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('glaccount_tax', function (Blueprint $table) {
            $table->integer('glaccount_tax')->change();
        });
    }

}
