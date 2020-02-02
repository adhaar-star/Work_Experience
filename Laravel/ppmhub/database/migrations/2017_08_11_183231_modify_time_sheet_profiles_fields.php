<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTimeSheetProfilesFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_sheet_profiles', function (Blueprint $table) {
            $table->dropColumn('changed_by');
            $table->integer('created_by')->change();
            $table->integer('updated_by')->nullable()->after('created_by');
            $table->integer('company_id')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('time_sheet_profiles', function (Blueprint $table) {
            $table->string('changed_by')->after('time_sheet_description');
            $table->string('created_by')->nullable()->change();
            $table->dropColumn('updated_by');
            $table->dropColumn('company_id');
        });
    }
}
