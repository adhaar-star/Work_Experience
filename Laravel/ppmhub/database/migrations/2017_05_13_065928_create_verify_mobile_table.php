<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifyMobileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('verify_mobile', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('phone',25);
            $table->string('verification_code',5);
            $table->string('status')->default('0');
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::dropIfExists('verify_mobile');
    }
}
