<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumnsAssignepersonTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personassignment', function (Blueprint $table) {
            $table->string('created_by')->nullable()->change();
            $table->string('changed_by')->nullable()->change();
            $table->string('company_id')->nullable()->change();
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
