<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubscriptionTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('user_subscription', function ($table) {
      $table->increments('subscription_Id');
      $table->integer('company_id')->unsigned();
      $table->foreign('company_id')->references('id')->on('company');
      $table->string('braintree_subscription_id', 50);
      $table->string('braintree_subscription_plan', 50);
      $table->integer('braintree_subscription_price');
      $table->datetime('next_billing_date');
      $table->datetime('ends_at')->nullable();
      $table->datetime('created_at');
      $table->datetime('updated_at')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('user_subscription');
  }

}
