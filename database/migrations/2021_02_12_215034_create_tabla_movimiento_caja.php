<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaMovimientoCaja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla_movimiento_caja', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cajas_id')->unsigned();
            $table->string('descripcion');
            $table->string('fecha');
            $table->string('entrada');
            $table->string('salida');
            $table->string('moneda');
            $table->string('saldoParcialPesos');
            $table->string('saldoParcialDolares');
            $table->string('tipo');
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
        Schema::dropIfExists('tabla_movimiento_caja');
    }
}
