<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('component_name',200);
            $table->integer('component_number');
            $table->integer('sprint_no');
            $table->integer('project_id');       
            $table->string('status',50);            
            $table->integer('created_by')->nullable();
            $table->timestamp('created_on')->nullable();
            $table->integer('changed_by')->nullable();
            $table->timestamp('changed_on')->nullable();           
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
        Schema::dropIfExists('component');
    }
}
