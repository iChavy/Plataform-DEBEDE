<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Correo_electronico', 100)->unique();
            $table->string('Contrasenya',20);
            $table->date('Fecha_Nacimiento');
            $table->integer('Saldo_Moneda');
            // $table->timestamp('email_verified_at')->nullable();

            $table->unsignedBigInteger('ID_Rol')->nullable();
            $table->foreign('ID_Rol')->references('id')->on('roles');

            $table->unsignedBigInteger('ID_Pais')->nullable();
            $table->foreign('ID_Pais')->references('id')->on('countries');

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
        Schema::dropIfExists('users');
    }
}
