<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeSheetProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('time_sheet_profiles', function (Blueprint $table) {
            $table->increments('time_sheet_profile_id')->unsigned();
            $table->string('time_sheet_profile_number',255);
            $table->string('time_sheet_number_days',255)->nullable();
            $table->string('time_sheet_entry_period',255);
            $table->string('time_sheet_description')->unique()->nullable();
            $table->string('changed_by',255)->nullable();
            $table->string('created_by',255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_sheet_profiles');
    }
}
