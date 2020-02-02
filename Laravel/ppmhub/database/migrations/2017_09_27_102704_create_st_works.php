<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStWorks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_works', function (Blueprint $table) {
            $table->increments('st_work_id');
            $table->integer('employee_id');
            $table->integer('approver_id')->nullable();
            $table->integer('on_behalf_approver_id')->nullable();
            $table->date('st_work_date');
            $table->enum('st_work_status', ['pending', 'approved', 'rejected', 'draft'])->default('pending');
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
        Schema::dropIfExists('st_works');
    }
}
