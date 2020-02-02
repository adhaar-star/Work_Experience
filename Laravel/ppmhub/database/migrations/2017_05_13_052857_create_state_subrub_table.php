<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateSubrubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('state_subrub', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('postcode',5);
            $table->string('subrub',100);
            $table->string('state',4);
            $table->decimal('latitude',6,3);
            $table->decimal('longitude',6,3);
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('state_subrub');
    }
}
