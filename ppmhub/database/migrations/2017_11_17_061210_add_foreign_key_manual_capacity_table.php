<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyManualCapacityTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manual_capacity', function (Blueprint $table) {
            $table->integer('bucket')->unsigned()->nullable()->change();
            $table->foreign('bucket')->references('id')->on('buckets');
            $table->integer('portfolio')->unsigned()->nullable()->change();
            $table->foreign('portfolio')->references('id')->on('portfolio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manual_capacity', function (Blueprint $table) {
            $table->dropForeign(['bucket']);
            $table->dropForeign(['portfolio']);
        });
    }

}
