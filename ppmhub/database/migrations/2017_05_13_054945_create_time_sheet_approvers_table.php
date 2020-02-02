<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeSheetApproversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('time_sheet_approvers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('time_sheet_user_id');
            $table->integer('time_sheet_approver_id');
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
         Schema::dropIfExists('time_sheet_approvers');
    }
}
