<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyconnectCostCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_centres', function (Blueprint $table) {
            $table->integer('changed_by')->nullable()->change();
            $table->integer('created_by')->change();
            $table->integer('company_id')->after('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_centres', function (Blueprint $table) {
            $table->string('changed_by', 128)->nullable()->change();
            $table->string('created_by', 128)->change();
            $table->dropColumn('company_id');
        });
    }
}
