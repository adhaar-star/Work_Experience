<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateChangedByActivityRatesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('activity_rates', function (Blueprint $table) {
            $table->string('changed_by', 255)->nullable()->change();
            $table->string('created_by', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('activity_rates', function (Blueprint $table) {
            $table->string('changed_by')->change();
            $table->string('created_by')->change();
        });
    }

}
