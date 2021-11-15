<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialProductoEnServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_producto_en_servicio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('detalle')->nullable();
            $table->bigInteger('productoservicio_id')->unsigned();
            $table->timestamps();

            $table->foreign('productoservicio_id')
                  ->references('id')
                  ->on('productos_en_servicios')
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
        Schema::dropIfExists('historial_producto_en_servicio');
    }
}
