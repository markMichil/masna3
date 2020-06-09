<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_invoice_details', function (Blueprint $table) {
            $table->increments('id');





            $table->integer('return_invoices_id')->unsigned();
            $table->foreign('return_invoices_id')->references('id')->on('return_invoices');


            $table->integer('products_id')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');

            $table->integer('quantity');
            $table->double('price');
            $table->double('price_d')->nullable();


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
        Schema::dropIfExists('return_invoice_details');
    }
}
