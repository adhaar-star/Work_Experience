<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePhaseTaskFieldsInOriginalBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('budget_original', function (Blueprint $table) {            
            $table->dropColumn('task');
            $table->dropColumn('phase');
            $table->integer('changed_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budget_original', function (Blueprint $table) {            
            $table->string('task')->nullable();
            $table->string('phase')->nullable();
            $table->dropColumn('changed_by');
        });
    }
}
