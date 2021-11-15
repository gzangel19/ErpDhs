<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesUnidadNegocioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes_unidad_negocio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('unidadnegocio_id')->unsigned();
            $table->bigInteger('cliente_id')->unsigned();
            $table->timestamps();

            $table->foreign('unidadnegocio_id')
                  ->references('id')
                  ->on('unidad_negocio')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('cliente_id')
                  ->references('id')
                  ->on('clientes')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes_unidad_negocio');
    }
}
