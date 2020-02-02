<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyActivityTypesFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_types', function (Blueprint $table) {
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
        Schema::table('activity_types', function (Blueprint $table) {
            $table->string('changed_by')->nullable()->after('validity_end');
            $table->string('created_by')->change();
            $table->dropColumn('updated_by');
            $table->dropColumn('company_id');
        });
    }
}
