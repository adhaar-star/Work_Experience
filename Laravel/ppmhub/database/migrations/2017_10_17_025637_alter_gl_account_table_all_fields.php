<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGlAccountTableAllFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('gl_accounts');
        Schema::create('gl_accounts', function (Blueprint $table) {

            $table->increments('gl_account_id');
            $table->integer('company_id');
            $table->string('number', 15);
            $table->string('gl_account_element_type', 40);
            $table->string('gl_account_type', 40);
            $table->string('gl_account_tax', 40);
            $table->string('description', 40);
            $table->string('type_flag', 40);
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
        Schema::dropIfExists('gl_accounts');
    }
}
