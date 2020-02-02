<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnPortfoliocapacityPlanningTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('portfolio_capacity_planning', function (Blueprint $table) {
            $table->integer('currency')->nullable();
            $table->integer('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('portfolio_capacity_planning', function (Blueprint $table) {
            $table->dropColumn('currency');
            $table->dropColumn('company_id');
        });
    }

}
