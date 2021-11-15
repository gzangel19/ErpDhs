<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewFieldPresupuesto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('presupuesto', function (Blueprint $table) {
            
            $table->bigInteger('cliente_id')->unsigned()->default(1);
            $table->string('tipo_entrega');
            $table->string('cotizacion');
            $table->string('totalDolares');
            $table->string('modo_venta');
            $table->string('mantenimiento');
            $table->string('nota');

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
        Schema::table('presupuesto', function (Blueprint $table) {
            //
        });
    }
}
