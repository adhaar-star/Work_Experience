<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypePortfolioPlanningTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('portfolio_resource_planning', function (Blueprint $table) {
            $table->string('distribute',100)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('portfolio_resource_planning', function (Blueprint $table) {
            $table->string('distribute',10)->change();
        });
    }

}
