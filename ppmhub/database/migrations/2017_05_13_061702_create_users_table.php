<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name',191);
            $table->string('lname',100);
            $table->string('email',191)->unique();
            $table->string('password',191);
            $table->string('phone',10);
            $table->integer('role_id');
            $table->string('remember_token',100)->nullable();
            $table->string('status')->default('deactive');
            $table->string('verify_code',6);
            $table->string('is_deleted')->default('No');
            $table->timestamps();
           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('users');
    }
}
