<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsPersonassignTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personassignment', function (Blueprint $table) {
            $table->date('created_by')->nullable();
            $table->date('changed_by')->nullable();
            $table->date('company_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personassignment', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('changed_by');
            $table->dropColumn('company_id');
        });
    }

}
