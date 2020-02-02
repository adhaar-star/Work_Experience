<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeProjectContingencyCostTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::table('project_contingency_cost', function (Blueprint $table) {
            $table->string('type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_contingency_cost', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }

}