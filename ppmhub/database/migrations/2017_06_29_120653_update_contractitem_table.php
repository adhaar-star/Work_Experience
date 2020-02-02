<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContractitemTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_item', function (Blueprint $table) {
            $table->string('created_by', 50)->nullable();
            $table->string('created_on', 50)->nullable();
            $table->string('changed_by', 50)->nullable();
            $table->string('processing_status', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_item', function (Blueprint $table) {
            $table->dropColumn('created_by');
            $table->dropColumn('created_on');
            $table->dropColumn('changed_by');
            $table->dropColumn('processing_status');
        });
    }

}
