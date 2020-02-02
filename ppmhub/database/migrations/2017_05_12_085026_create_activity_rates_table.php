<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_rates', function (Blueprint $table) {
            $table->increments('activity_rate_id',10)->unsigned();
            $table->string('activity_rate_description')->unique();
            $table->string('activity_actual_rate',70);
            $table->string('activity_plan_rate',70);
            $table->date('activity_validity_start');
            $table->date('activity_validity_end');
            $table->integer('activity_type_id');
            $table->integer('cost_centre_id');
            $table->integer('employee_id');
            $table->string('changed_by');
            $table->string('created_by');
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
        Schema::dropIfExists('activity_rates');
    }
}
