<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaquinarias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinariass', function (Blueprint $table) {
            
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('cliente_id')->unsigned();
            $table->string('ubicacion');
            $table->string('modelo');
            $table->string('numeroSerie');
            $table->string('tipo');
            $table->string('estado');   
            $table->timestamps();
    
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
        Schema::dropIfExists('maquinarias');
    }
}
