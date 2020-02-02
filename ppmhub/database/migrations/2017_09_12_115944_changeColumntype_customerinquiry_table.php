<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumntypeCustomerinquiryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->string('inquiry_description', 250)->change();
        });
         Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->string('short_description',40)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('customer_inquiry', function (Blueprint $table) {
            $table->string('inquiry_description', 40)->change();
        });
         Schema::table('customer_inquiry_item', function (Blueprint $table) {
            $table->string('short_description',191)->change();
        });
    }

}
