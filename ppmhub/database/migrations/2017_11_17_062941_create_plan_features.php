<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanFeatures extends Migration {

   /**
    * Run the migrations.
    * plan_id will be the id of plan table
    * admin - admin access count
    * user - number of user can be create in company
    * project - number of user can be create in company
    * 
    * @return void
    */
   public function up() {
      Schema::create('plan_features', function (Blueprint $table) {
         $table->increments('id');
         $table->string('plan_id');
         $table->integer('admin')->nullable();
         $table->integer('user')->nullable();
         $table->integer('project')->nullable();
         $table->timestamps();
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down() {
      Schema::dropIfExists('plan_features');
   }

}
