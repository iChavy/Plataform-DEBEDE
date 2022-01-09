<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_methods', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ID_Banco')->nullable();
            $table->foreign('ID_Banco')->references('id')->on('banks');

            $table->unsignedBigInteger('ID_Metodo')->nullable();
            $table->foreign('ID_Metodo')->references('id')->on('payment_methods');
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
        Schema::dropIfExists('bank_methods');
    }
}
