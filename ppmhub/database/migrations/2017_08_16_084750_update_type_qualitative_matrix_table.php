<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTypeQualitativeMatrixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('qualitative_matrix', function (Blueprint $table) {
           $table->decimal('risk_value',5,2)->nullable()->change();
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qualitative_matrix', function (Blueprint $table) {
          $table->integer('risk_value')->nullable()->change();
       });
    }
}
