<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesListTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('issues_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 300);
            $table->integer('issueTypeId')->nullable();
            $table->longText('description');
            $table->integer('projectId')->nullable();
            $table->integer('phaseId')->nullable();
            $table->integer('taskId')->nullable();
            $table->integer('assignee')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->timestamp('close_date')->nullable();
            $table->timestamp('due_date')->nullable();
            $table->string('priority', 30);
            $table->integer('estimated_duration')->nullable();
            $table->integer('parentID')->nullable();
            $table->integer('status')->nullable();
            $table->integer('duration_unit')->nullable();
            $table->integer('projectManager')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamp('created_on')->nullable();
            $table->integer('changed_by')->nullable();
            $table->timestamp('changed_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('issues_list');
    }

}
