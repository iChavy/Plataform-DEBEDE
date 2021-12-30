<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeographicRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geographic_restrictions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ID_Pais')->nullable();
            $table->foreign('ID_Pais')->references('id')->on('countries');

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
        Schema::dropIfExists('geographic_restrictions');
    }
}
