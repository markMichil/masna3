<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartReturnInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_return_invoices', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('products_id')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');

            $table->integer('factories_id')->unsigned();
            $table->foreign('factories_id')->references('id')->on('factories');

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
        Schema::dropIfExists('cart_return_invoices');
    }
}
