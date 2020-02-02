<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('activity_types', function (Blueprint $table) {
            $table->increments('activity_id',10)->unsigned();
            $table->string('activity_type',255);
            $table->string('activity_description')->unique();
            $table->string('cost_element',255);
            $table->string('cost_element_description')->unique();
            $table->date('validity_start');
            $table->date('validity_end');
            $table->string('changed_by',255);
            $table->string('created_by',255);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('activity_types');
    }
}
