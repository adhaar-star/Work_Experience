<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetReturnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_return', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_id',255)->nullable();
            $table->string('period_from')->nullable();
            $table->string('period_to')->nullable();
            $table->string('overall')->nullable();
            $table->string('year1')->nullable();
            $table->string('year2')->nullable();
            $table->string('year3')->nullable();
            $table->string('year4')->nullable();
            $table->string('year5')->nullable();
            $table->string('phase',255)->nullable();
            $table->string('task',255)->nullable();
            $table->string('return')->nullable();
            $table->string('current_budget')->nullable();
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
        Schema::dropIfExists('budget_return');
    }
}
