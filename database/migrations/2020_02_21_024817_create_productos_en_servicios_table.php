<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosEnServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_en_servicios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('estado',['alquilado', 'libre']);
            $table->string('numero_serie');
            $table->bigInteger('producto_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('productos_en_servicios');
    }
}
