<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumn extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('project_milestone', function (Blueprint $table) {
//            $table->string('phase_id', 255)->nullable();
//            $table->string('task_id', 255)->nullable();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('project_milestone', function (Blueprint $table) {
//            $table->dropColumn('phase_id');
//            $table->dropColumn('task_id');
//        });
    }

}
