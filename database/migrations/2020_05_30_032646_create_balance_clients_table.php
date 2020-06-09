<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalanceClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_clients', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('clients_id')->unsigned();
            $table->foreign('clients_id')->references('id')->on('clients');

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
        Schema::dropIfExists('balance_clients');
    }
}
