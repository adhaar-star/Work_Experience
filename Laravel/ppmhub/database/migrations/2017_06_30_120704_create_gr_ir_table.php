<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrIrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gr_ir', function (Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_id')->nullable();
            $table->string('po_number')->nullable();
            $table->string('item')->nullable();
            $table->string('gr_value')->nullable();
            $table->string('currency')->nullable();
            $table->string('material_documber_number')->nullable();
            $table->string('posting_date')->nullable();
            $table->string('posted_by')->nullable();
            $table->string('invoice_verification')->nullable();
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
        Schema::dropIfExists('gr_ir');
    }
}
