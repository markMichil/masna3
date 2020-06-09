<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->string('image')->nullable();

            $table->integer('quantity');
            $table->double('price');
            $table->double('sell');
            $table->boolean('discount')->default(0);
            $table->double('price_D')->nullable();
            $table->double('sell_D')->nullable();

            $table->integer('factories_id')->unsigned();
            $table->foreign('factories_id')->references('id')->on('factories');





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
        Schema::dropIfExists('products');
    }
}
