<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimeSheetApproversFieldModification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_sheet_approvers', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->integer('changed_by')->nullable()->change();
            $table->integer('changed_by')->nullable(false)->change();
            $table->renameColumn('changed_by', 'updated_by');
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
        Schema::table('time_sheet_approvers', function (Blueprint $table) {
            $table->boolean('status');
            $table->string('updated_by')->nullable()->change();
            $table->string('created_by')->nullable()->change();
            $table->renameColumn('updated_by', 'changed_by');
            $table->dropColumn('company_id');
        });
    }
}
