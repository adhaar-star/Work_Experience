<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttachmentProjectIssueTable extends Migration
{
       /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('issues_list', function (Blueprint $table) {
            $table->string('attachment',1000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
       Schema::table('issues_list', function (Blueprint $table) {
            $table->dropColumn('attachment');
        });
    }
}
