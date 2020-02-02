<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissonMastersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisson_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->string('method')->nullable();
            $table->integer('permission')->nullable();
            $table->integer('parent')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('changed_by')->nullable();
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
        Schema::dropIfExists('permisson_masters');
    }

}
