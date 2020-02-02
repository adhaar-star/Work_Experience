<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatCompanyTableForCompanyNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('company');

        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('logo')->nullable();
            $table->string('address');
            $table->integer('country')->unsigned();
            $table->foreign('country')->references('id')->on('country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
