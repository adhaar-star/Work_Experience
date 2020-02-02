<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProjectMilestoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('project_milestone', function (Blueprint $table) {
//            $table->tinyInteger('billing_status')->default(0)->after('status');
//            $table->decimal('billingplan_date')->default(0)->change();
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
//            $table->dropColumn('billing_status');
//        });
    }

}
