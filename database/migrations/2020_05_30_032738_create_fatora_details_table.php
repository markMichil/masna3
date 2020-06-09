<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFatoraDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fatora_details', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('fatoras_id')->unsigned();
            $table->foreign('fatoras_id')->references('id')->on('fatoras');


            $table->integer('products_id')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');

            $table->integer('quantity');

            $table->double('sell');
            $table->double('sell_d')->nullable();



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
        Schema::dropIfExists('fatora_details');
    }
}
