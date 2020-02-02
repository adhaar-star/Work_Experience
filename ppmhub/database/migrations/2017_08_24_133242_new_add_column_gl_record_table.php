<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewAddColumnGlRecordTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gl_records', function (Blueprint $table) {

            $table->string('remark')->nullable();
            $table->string('ref_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gl_records', function (Blueprint $table) {

            $table->dropColumn('remark');
            $table->dropColumn('ref_id');
        });
    }

}
