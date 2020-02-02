<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableNullableCompanyNameCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */
    public function up()
    {       
        Schema::table('company', function (Blueprint $table) {
            $table->string('company_name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('company', function (Blueprint $table) {
            $table->string('company_name')->change();
        });
    }
}
