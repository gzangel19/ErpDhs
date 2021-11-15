<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedoresUnidadNegocio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores_unidad_negocio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('unidadnegocio_id')->unsigned();
            $table->bigInteger('proveedor_id')->unsigned();
            $table->timestamps();

            $table->foreign('unidadnegocio_id')
                  ->references('id')
                  ->on('unidad_negocio')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('proveedor_id')
                  ->references('id')
                  ->on('proveedores')
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
        Schema::dropIfExists('proveedores_unidad_negocio');
    }
}
