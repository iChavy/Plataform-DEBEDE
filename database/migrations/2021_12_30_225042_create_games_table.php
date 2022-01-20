<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string("Nombre",100);
            $table->integer("Numero_Ventas");
            $table->integer("Precio");
            $table->string("Link",200);
            $table->string("Link_Demo",200);
            $table->unsignedBigInteger('ID_Restriccion')->nullable();
            $table->foreign('ID_Restriccion')->references('id')->on('age_restrictions');
            $table->unsignedBigInteger('ID_Usuario')->nullable();
            $table->foreign('ID_Usuario')->references('id')->on('users');
            $table->boolean("borrado");
            $table->text('imagen');
            $table->text('Descripcion');
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
        Schema::dropIfExists('games');
    }
}
