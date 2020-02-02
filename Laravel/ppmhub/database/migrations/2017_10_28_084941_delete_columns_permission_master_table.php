<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnsPermissionMasterTable extends Migration
{

    public function up()
    {
        Schema::table('permisson_masters', function (Blueprint $table) {
            $table->unsignedInteger('id')->change();
            $table->dropPrimary('id');
            $table->dropColumn('id');
            $table->dropColumn('method');
            $table->dropColumn('company_id')->nullable();
            $table->dropColumn('created_by')->nullable();
            $table->dropColumn('changed_by')->nullable();
            $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permisson_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('method')->nullable();
            $table->integer('company_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('changed_by')->nullable();
            $table->timestamps();
        });
    }

}
