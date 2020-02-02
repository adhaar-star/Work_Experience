<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('portfolio', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name',128)->nullable();
            $table->string('port_id',100)->nullable();
            $table->integer('type')->nullable();
            $table->integer('buckets')->nullable();
            $table->integer('capacity_unit')->nullable();
            $table->integer('planning_unit')->nullable();
            $table->string('currency',10)->nullable();
            $table->text('description')->nullable();
            $table->string('created_by',128)->unique()->nullable();
            $table->dateTime('created_at')->nullable();
            $table->string('edited_by',128)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('status')->default('active');
            $table->string('deleted')->default('N');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('portfolio');
    }
}
