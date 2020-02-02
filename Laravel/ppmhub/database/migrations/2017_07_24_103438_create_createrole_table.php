<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreateroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('createrole', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name')->nullable();
            $table->string('role_type')->nullable();
            $table->string('role_fun')->nullable();
            $table->string('description')->nullable();
            $table->string('resource_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('createrole');
    }
}
