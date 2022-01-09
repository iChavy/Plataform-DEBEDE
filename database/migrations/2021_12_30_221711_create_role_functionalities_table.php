<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleFunctionalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_functionalities', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ID_funcionalidad')->nullable();
            $table->foreign('ID_funcionalidad')->references('id')->on('functionalities');

            $table->unsignedBigInteger('ID_Rol')->nullable();
            $table->foreign('ID_Rol')->references('id')->on('roles');

            $table->boolean("borrado");

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
        Schema::dropIfExists('role_functionalities');
    }
}
