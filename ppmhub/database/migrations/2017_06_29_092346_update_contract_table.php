<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContractTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract', function (Blueprint $table) {

            $table->renameColumn('contract_number', 'agreement_number');
            $table->string('agreement_type')->nullable();
            $table->string('target_value')->nullable();
            $table->string('value_unit')->nullable();
            $table->string('vendor')->nullable();
            $table->string('agreement_date')->nullable();
            $table->string('validity_start')->nullable();
            $table->string('validity_end')->nullable();
            $table->string('quotation_date')->nullable();
            $table->string('quotation_no')->nullable();
            $table->string('sales_contact')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract', function (Blueprint $table) {
            $table->renameColumn('agreement_number', 'contract_number');
            $table->dropColumn('agreement_type');
            $table->dropColumn('target_value');
            $table->dropColumn('value_unit');
            $table->dropColumn('vendor');
            $table->dropColumn('agreement_date');
            $table->dropColumn('validity_start');
            $table->dropColumn('validity_end');
            $table->dropColumn('quotation_date');
            $table->dropColumn('quotation_no');
            $table->dropColumn('sales_contact');
        });
    }

}
