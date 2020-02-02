<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name')->nullable();
            $table->string('changed_by')->nullable();
            $table->string('created_by')->nullable();
            $table->string('company_id')->nullable();
            
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
        Schema::dropIfExists('roles_masters');
    }
}
