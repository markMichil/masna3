<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceFactoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_factories', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('factories_id')->unsigned();
            $table->foreign('factories_id')->references('id')->on('factories');

            $table->double('amount');
            $table->text('reason');
            $table->integer('type_balance');
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
        Schema::dropIfExists('balance_factories');
    }
}
