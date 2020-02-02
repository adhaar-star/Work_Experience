<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSprintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprint', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('sprint_number');
            $table->string('sprint_period',50);
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('sprint');
    }
}
