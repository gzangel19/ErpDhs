<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialMovimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_movimientos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('movimiento_id')->unsigned();
            $table->string('fecha')->nullable();
            $table->enum('estado', ['Pedido','Preparado','Enviado','Recibido',])->default('pedido');
            $table->timestamps();

            $table->foreign('movimiento_id')
                  ->references('id')
                  ->on('movimientos_deposito')
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
        Schema::dropIfExists('historial_movimientos');
    }
}
