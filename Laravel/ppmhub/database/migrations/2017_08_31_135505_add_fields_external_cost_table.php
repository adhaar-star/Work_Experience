<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsExternalCostTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_external_resource_cost', function (Blueprint $table) {
            $table->string('activity_type')->nullable();
            $table->string('requisition_item')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_external_resource_cost', function (Blueprint $table) {
            $table->dropColumn('activity_type');
            $table->dropColumn('requisition_item');
            
        });
    }

}
