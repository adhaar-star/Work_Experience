<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBucketFinancialPlanningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bucket_financial_planning', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('bucket_id');
            $table->string('bucket_name',128);
            $table->integer('portfolio_id');
            $table->string('portfolio_name',128);
            $table->integer('total_period');
            $table->string('distribute',10);
            $table->string('planning_start',100);
            $table->string('planning_end',100);
            $table->integer('planning_unit');
            $table->integer('added_by');
            $table->timestamp('created_date');
            $table->string('created_by',128);
            $table->string('edited_by',128);
            $table->dateTime('edited_date');
            $table->string('status')->default('active');
            $table->string('is_delete')->default('no');
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
       Schema::dropIfExists('bucket_financial_planning');
    }
}
