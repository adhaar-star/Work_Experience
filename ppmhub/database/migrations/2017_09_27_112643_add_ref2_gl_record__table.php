<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRef2GlRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::table('gl_records', function (Blueprint $table) {
           
           $table->string('item_no')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('gl_records', function (Blueprint $table) {
           
              $table->dropColumn('item_no');
            
        });
    }
}
