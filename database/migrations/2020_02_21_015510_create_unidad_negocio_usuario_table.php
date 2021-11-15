<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadNegocioUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_negocio_usuario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('unidadnegocio_id')->unsigned();
            $table->bigInteger('usuario_id')->unsigned();
            $table->timestamps();

            $table->foreign('unidadnegocio_id')
                  ->references('id')
                  ->on('unidad_negocio')
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
        Schema::dropIfExists('unidad_negocio_usuario');
    }
}
