<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInCostForecastingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_forecasting', function (Blueprint $table) {
            $table->string('plan_cost');
            $table->string('forecast_total');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_forecasting', function (Blueprint $table) {
            $table->dropColumn('plan_cost');
            $table->dropColumn('forecast_total');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }
}
