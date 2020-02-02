<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyconnectStateSubrubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('state_subrub', function (Blueprint $table) {
            $table->integer('company_id');
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
        Schema::table('state_subrub', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
