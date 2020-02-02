<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsPurchaseItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function up()
    {
        Schema::table('purchase_item', function (Blueprint $table) {
           $table->string('project_id',255)->nullable();
            $table->string('phase_id',255)->nullable();
            $table->string('task_id',255)->nullable();
            $table->string('g_l_account',255)->nullable();
            $table->string('cost_center',255)->nullable();
            $table->string('created_by',50)->nullable();
            $table->dateTime('created_on')->nullable();   //duplicate field available in the timstamp command
            $table->string('changed_by',50)->nullable();
            $table->string('approver_1',50)->nullable();
            $table->string('approver_2',50)->nullable();
            $table->string('approver_3',50)->nullable();
            $table->string('approver_4',50)->nullable();
            $table->string('approved_indicator',50)->nullable();
            $table->string('processing_status',50)->nullable();
            $table->string('title',50)->nullable();
            $table->string('name',50)->nullable();
            $table->string('add1',255)->nullable();
            $table->string('add2',255)->nullable();
            $table->string('postal_code',50)->nullable();
            $table->string('country',255)->nullable();
            $table->string('approver_token',50)->nullable();	 		
	
        });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::table('purchase_item', function (Blueprint $table) {
           $table->dropColumn('project_id');
            $table->dropColumn('phase_id');
            $table->dropColumn('task_id');
            $table->dropColumn('g_l_account');
            $table->dropColumn('cost_center');
            $table->dropColumn('created_by');
            $table->dropColumn('created_on');   //duplicate field available in the timstamp command
            $table->dropColumn('changed_by');
            $table->dropColumn('approver_1');
            $table->dropColumn('approver_2');
            $table->dropColumn('approver_3');
            $table->dropColumn('approver_4');
            $table->dropColumn('approved_indicator');
            $table->dropColumn('processing_status');
            $table->dropColumn('title');
            $table->dropColumn('name');
            $table->dropColumn('add1');
            $table->dropColumn('add2');
            $table->dropColumn('postal_code');
            $table->dropColumn('country');
            $table->dropColumn('approver_token');	 		
	
        });
    }
}
