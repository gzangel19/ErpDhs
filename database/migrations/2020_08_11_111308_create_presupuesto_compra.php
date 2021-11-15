<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestoCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos_compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('proveedor_id')->unsigned();
            $table->bigInteger('usuario_id')->unsigned();
            $table->string('num_comprobante');
            $table->string('fecha');
            $table->string('total');
            $table->string('estado');
            $table->string('formaPago')->nullable();;
            $table->string('fechaPago')->nullable();;
            $table->string('cuenta')->nullable();;
            $table->timestamps();

            $table->foreign('proveedor_id')
                  ->references('id')
                  ->on('proveedores')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

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
        Schema::dropIfExists('presupuestos_compras');
    }
}
