<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeQuantitativeRiskscoreTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('quantitative_riskscore', function (Blueprint $table) {
            $table->bigInteger('start_range')->change();
            $table->bigInteger('end_range')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('quantitative_riskscore', function (Blueprint $table) {
            $table->string('start_range')->change();
            $table->string('end_range')->change();
        });
    }

}
