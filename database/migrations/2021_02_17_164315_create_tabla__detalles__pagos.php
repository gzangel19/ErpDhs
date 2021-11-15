<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaDetallesPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pagos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('pagos_id')->unsigned();
            $table->string('fecha');
            $table->string('monto');
            $table->timestamps();
    
    
            $table->foreign('pagos_id')
                  ->references('id')
                  ->on('pagos_cuentas')
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
        Schema::dropIfExists('detalle_pagos');
    }
}
