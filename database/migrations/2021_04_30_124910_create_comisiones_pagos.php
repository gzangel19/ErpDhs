<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComisionesPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comisiones_pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('usuario_id')->unsigned();
            $table->string('totalVendido');
            $table->string('porcentajeVenta');
            $table->string('bonus');
            $table->string('montoBonus');
            $table->string('comision');
            $table->string('fechaDesde');
            $table->string('fechaHasta');
            $table->string('mes');
            $table->string('estado');
            $table->timestamps();
    
            $table->foreign('usuario_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('comisiones_pagos');
    }
}
