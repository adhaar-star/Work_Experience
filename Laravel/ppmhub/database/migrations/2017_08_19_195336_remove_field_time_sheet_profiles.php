<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldTimeSheetProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_sheet_profiles', function (Blueprint $table) {
            $table->dropColumn('time_sheet_profile_number');
            $table->string('status')->change();
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
            $table->string('time_sheet_profile_number', 255);
            $table->tinyInteger('status')->change();
        });
    }
}
