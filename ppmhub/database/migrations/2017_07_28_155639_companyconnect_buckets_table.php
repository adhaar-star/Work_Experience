<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyconnectBucketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buckets', function (Blueprint $table) {
            $table->integer('created_by')->change();
            $table->integer('edited_by')->nullable()->change();
            $table->integer('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buckets', function (Blueprint $table) {
            $table->string('created_by', 128)->change();
            $table->string('edited_by', 128)->nullable()->change();
            $table->dropColumn('company_id');
        });
    }
}