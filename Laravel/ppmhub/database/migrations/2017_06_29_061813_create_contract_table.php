<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('contract', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contract_number', 50)->nullable();
            $table->string('description')->nullable();
            $table->string('created_on', 50)->nullable();
            $table->string('created_by', 50)->nullable();
            $table->string('requested_by', 50)->nullable();
            $table->string('status', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('contract', function (Blueprint $table) {
            Schema::dropIfExists('contract');
        });
    }
}
