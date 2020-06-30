<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('invoices_id')->unsigned();
            $table->foreign('invoices_id')->references('id')->on('invoices');


            $table->integer('products_id')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');

            $table->integer('quantity');
            $table->double('price');
            $table->double('sell');
$table->double('price_D')->nullable();
            $table->double('sell_D')->nullable();


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
        Schema::dropIfExists('invoice_details');
    }
}
