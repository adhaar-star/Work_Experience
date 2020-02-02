<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBacklogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
                 
        Schema::create('backlog', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('sprint_no');
            $table->integer('issue_no');
            $table->integer('component_no');       
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
        Schema::dropIfExists('backlog');
    }
}
