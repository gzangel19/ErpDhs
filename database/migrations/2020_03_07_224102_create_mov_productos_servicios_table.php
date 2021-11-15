<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovProductosServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mov_productos_servicios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('estado',['activo', 'inactivo']);
            $table->date('fecha_baja')->nullable();
            $table->bigInteger('servicio_id')->unsigned();
            $table->bigInteger('productoenservicio_id')->unsigned();
            $table->timestamps();

            $table->foreign('servicio_id')
                  ->references('id')
                  ->on('servicios')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('productoenservicio_id')
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
        Schema::dropIfExists('mov_productos_servicios');
    }
}
