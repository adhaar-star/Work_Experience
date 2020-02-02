<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBucketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('buckets', function (Blueprint $table) {
            $table->increments('id',11)->unsigned();
            $table->string('name',128);
            $table->string('bucket_id',50)->default(0);
            $table->integer('portfolio_id');
            $table->integer('parent_bucket')->default(0);
            $table->integer('costcentretype')->unsigned()->nullable();
            $table->integer('department');
            $table->string('currency',10);
            $table->string('description')->unique();
            $table->string('created_by',128)->nullable();
            $table->timestamp('created_date');
            $table->string('edited_by',128)->nullable();
            $table->string('status')->default('active');
            $table->string('is_delete')->default('N');

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
         Schema::dropIfExists('buckets');
    }
}

   