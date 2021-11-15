<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaPagosCuenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_cuentas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pedido_id')->unsigned();
            $table->string('montoRestante');
            $table->string('estado');
            $table->timestamps();
    
    
            $table->foreign('pedido_id')
                  ->references('id')
                  ->on('pedidos')
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
        Schema::dropIfExists('pagos_cuentas');
    }
}
