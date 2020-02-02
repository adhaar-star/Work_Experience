<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterRangeNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_range_numbers', function (Blueprint $table) {

            $table->increments('master_range_number_id')->unsigned();
            $table->integer('company_id');

            $table->bigInteger('start');
            $table->bigInteger('end');
            $table->integer('model');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('master_range_numbers');
    }
}
