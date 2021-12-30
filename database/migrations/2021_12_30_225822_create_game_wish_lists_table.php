<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameWishListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_wish_lists', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ID_Lista')->nullable();
            $table->foreign('ID_Lista')->references('id')->on('wish_lists');

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
        Schema::dropIfExists('game_wish_lists');
    }
}
