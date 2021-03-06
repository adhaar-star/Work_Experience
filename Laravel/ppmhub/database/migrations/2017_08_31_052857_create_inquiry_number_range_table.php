<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInquiryNumberRangeTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('inquirynumber_range', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('start_range')->nullable();
            $table->bigInteger('end_range')->nullable();
            $table->integer('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('inquirynumber_range');
    }

}
