<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePresupuestoCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_presupuesto_compra', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('presupuestos_compras_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->string('cantidad');
            $table->string('precio');
            $table->timestamps();

            $table->foreign('presupuestos_compras_id')
                  ->references('id')
                  ->on('presupuestos_compras')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('producto_id')
                  ->references('id')
                  ->on('productos')
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
        Schema::dropIfExists('detalle_presupuesto_compra');
    }
}
