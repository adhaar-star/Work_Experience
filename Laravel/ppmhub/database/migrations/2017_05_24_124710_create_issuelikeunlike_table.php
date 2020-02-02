<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuelikeunlikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issuelikeunlike', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('issueId')->nullable();
               $table->integer('userId')->nullable();
                  $table->integer('action')->nullable();
           
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
        Schema::dropIfExists('issuelikeunlike');
    }
}
