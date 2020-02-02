<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnProjectChecklist extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('project_checklist', function (Blueprint $table) {
            $table->string('checklist_status')->nullable();
            $table->dateTime('changed_on')->nullable()->change();
            $table->string('duration')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('project_checklist', function (Blueprint $table) {
            $table->dropColumn('checklist_status');
            $table->dateTime('changed_on')->change();
            $table->dateTime('duration')->nullable()->change();
        });
    }

}
