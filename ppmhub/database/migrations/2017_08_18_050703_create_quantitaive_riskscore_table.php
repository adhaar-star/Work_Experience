<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantitaiveRiskscoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('quantitative_riskscore', function (Blueprint $table) {
            $table->increments('id');
            $table->string('start_range')->nullable();
            $table->string('end_range')->nullable();
            $table->integer('risk_value')->nullable();
            $table->string('risk_status')->nullable();
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
          Schema::dropIfExists('quantitative_riskscore');
    }
}
