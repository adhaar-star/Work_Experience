<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectSoftwareCostTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_software_cost', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_number')->nullable();
            $table->string('task')->nullable();
            $table->string('software_descripton')->nullable();
            $table->string('purchase_order')->nullable();
            $table->string('po_item_no')->nullable();
            $table->string('quantity')->nullable();
            $table->string('currency')->nullable();
            $table->string('total_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_software_cost', function (Blueprint $table) {
            Schema::dropIfExists('project_software_cost');
        });
    }

}
