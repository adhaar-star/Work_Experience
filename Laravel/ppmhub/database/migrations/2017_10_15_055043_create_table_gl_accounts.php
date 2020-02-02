<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGlAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl_accounts', function (Blueprint $table) {

            $table->increments('gl_account_id');
            $table->integer('company_id');

            $table->string('number', 10);
            $table->string('gl_account_element_type', 20);
            $table->string('gl_account_type', 20);
            $table->string('gl_account_tax', 20);

            $table->string('description', 18);
            $table->enum('type_flag', ['EXPR', 'GRIR', 'GSPR', 'FAPR', 'FASA', 'GSSA']);

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
