<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCreatedByInBudgetReturnOriginalSupplement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('budget_return', function (Blueprint $table) {                       
            $table->integer('created_by')->nullable();
        });
        
        Schema::table('budget_original', function (Blueprint $table) {            
            $table->integer('created_by')->nullable();
        });
        
        Schema::table('budget_supplement', function (Blueprint $table) {            
            $table->integer('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('budget_return', function (Blueprint $table) {                       
            $table->dropColumn('created_by');
        });
        
        Schema::table('budget_original', function (Blueprint $table) {            
            $table->dropColumn('created_by');
        });
        
        Schema::table('budget_supplement', function (Blueprint $table) {            
            $table->dropColumn('created_by');
        });
    }
}