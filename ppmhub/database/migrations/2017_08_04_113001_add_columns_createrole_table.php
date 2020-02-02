<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsCreateroleTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('createrole', function (Blueprint $table) {
            $table->string('created_by')->nullable();
            $table->string('changed_by')->nullable();
            $table->string('company_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('createrole', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('changed_by');
            $table->dropColumn('company_id');
        });
    }

}
