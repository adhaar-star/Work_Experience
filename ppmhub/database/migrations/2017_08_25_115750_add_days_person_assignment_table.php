<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDaysPersonAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('personassignment', function (Blueprint $table) {
           for($i=1;$i<=90;$i++){
                 $table->integer('day'.$i)->nullable();
           }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personassignment', function (Blueprint $table) {
           for($i=1;$i<=90;$i++){
                 $table->drop_column('day'.$i);
           }
        });
    }
}
