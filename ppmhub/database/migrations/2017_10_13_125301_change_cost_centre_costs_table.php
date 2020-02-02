<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCostCentreCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('cost_centre_cost', function($table) {
            $table->renameColumn('debit', 'amount');
            $table->renameColumn('credit', 'dr_cr_indicator');
            $table->string('vendor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('cost_centre_cost', function($table) {
            $table->renameColumn('amount', 'debit');
            $table->renameColumn('dr_cr_indicator', 'credit');
            $table->dropColumn('vendor');
        });
    }
}
