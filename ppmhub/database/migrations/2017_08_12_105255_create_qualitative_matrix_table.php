<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualitativeMatrixTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('qualitative_matrix', function (Blueprint $table) {
            $table->increments('id');
            $table->string('qualitative_impact')->nullable();
            $table->string('qualitative_probability')->nullable();
            $table->integer('risk_value')->nullable();
            $table->string('risk_score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('qualitative_matrix');
    }

}
