<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveReturnAndSupplementFieldBudgetReturnSuplementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('budget_return', function (Blueprint $table) {                       
            $table->dropColumn('return');
        });
        
        Schema::table('budget_supplement', function (Blueprint $table) {                       
            $table->dropColumn('supplement');
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
            $table->string('return')->nullable();
        });
        
        Schema::table('budget_supplement', function (Blueprint $table) {                                   
            $table->string('supplement')->nullable();
        });
    }
}
