<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ID_Transaccion')->nullable();
            $table->foreign('ID_Transaccion')->references('id')->on('transactions');

            $table->unsignedBigInteger('Codigo_Juego')->nullable();
            $table->foreign('Codigo_Juego')->references('id')->on('games');
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
        Schema::dropIfExists('game_transactions');
    }
}
