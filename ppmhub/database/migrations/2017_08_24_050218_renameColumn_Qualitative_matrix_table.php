<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnQualitativeMatrixTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('qualitative_matrix', function (Blueprint $table) {
            $table->renameColumn('qualitative_impact', 'qualitative_likelihood');
            $table->renameColumn('qualitative_probability', 'qualitative_consequence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('qualitative_matrix', function (Blueprint $table) {
            $table->renameColumn('qualitative_likelihood', 'qualitative_impact');
            $table->renameColumn('qualitative_consequence', 'qualitative_probability');
        });
    }

}
