<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gl_account_number')->nullable();
            $table->string('gl_account_description')->nullable();
            $table->string('cost_element_type')->nullable();
            $table->string('debit')->nullable();
            $table->string('credit')->nullable();
            $table->string('balance')->nullable();
            $table->string('year')->nullable();
                $table->string('Period')->nullable();
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
        Schema::dropIfExists('gl');
    }
}
