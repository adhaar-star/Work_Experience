<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesdDocumentstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_documents', function (Blueprint $table) {

            $table->increments('sales_document_id');
            $table->integer('company_id');
            $table->integer('sales_document_no');
            $table->integer('customer');

            $table->integer('region')->nullable();
            $table->integer('organization')->nullable();
            $table->integer('requested_by')->nullable();

            $table->decimal('down_payment')->default(0.00);
            $table->decimal('gross_price')->default(0.00);
            $table->decimal('discount_amount')->default(0.00);
            $table->decimal('tax_amount')->default(0.00);
            $table->decimal('profit_margin_amount')->default(0.00);
            $table->decimal('freight_charges')->default(0.00);
            $table->decimal('total_price')->default(0.00);

            $table->string('description')->nullable();
            $table->enum( 'sales_document_type',  [ 'inquiry', 'quotation' ]);
            $table->enum('sales_document_status', [ 'created', 'draft', 'pending', 'success' ]);

            $table->enum('sales_order_type', ['service', 'goods', 'milestone', 'timesheet' ]);

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
        Schema::dropIfExists('sales_documents');
    }
}
