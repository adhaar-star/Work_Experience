<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('cost_centres', function (Blueprint $table) {
            $table->increments('cost_id')->unsigned();
            $table->string('cost_centre',255);
            $table->string('cost_description')->unique();
            $table->string('company_code',255);
            $table->string('company_code_description')->unique();
            $table->date('validity_start');
            $table->date('validity_end');
           $table->string('changed_by', 255)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('created_by',255);
           $table->string('updated_by', 255)->nullable();
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
       Schema::dropIfExists('cost_centres');
    }
}
