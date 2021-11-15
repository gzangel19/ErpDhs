<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientosDepositoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos_deposito', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idPedido');
            $table->bigInteger('idDepositoDestino');
            $table->bigInteger('idDepositoOrigen');
            $table->bigInteger('idProducto');
            $table->bigInteger('cantidad');
            $table->string('numero_seguimiento')->nullable()->default('S/N');
            $table->enum('estado', ['Pedido','Preparado','Enviado','Recibido',])->default('pedido');
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
        Schema::dropIfExists('movimientos_deposito');
    }
}
