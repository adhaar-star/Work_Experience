<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('project_milestone', function (Blueprint $table) {
//            
//           $table->renameColumn('a_start_date','finish_date');
//            $table->renameColumn('l_start_date','fixed_date');
//            $table->renameColumn('l_end_date','actual_date');
//            $table->renameColumn('e_start_date','schedule_date');
//            $table->renameColumn('e_end_date','billingplan_date');
//            $table->renameColumn('a_end_date','progress_date');
//            $table->renameColumn('end_date','event_date');
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
//            $table->renameColumn('finish_date','a_start_date');
//            $table->renameColumn('fixed_date','l_start_date');
//            $table->renameColumn('actual_date','l_end_date');
//            $table->renameColumn('schedule_date','e_start_date');
//            $table->renameColumn('billingplan_date','e_end_date');
//            $table->renameColumn('progress_date','a_end_date');
//            $table->renameColumn('event_date','end_date');
//        });
       
    }
}
