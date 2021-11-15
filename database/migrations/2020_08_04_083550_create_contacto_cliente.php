<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactoCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacto_cliente', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->engine = 'InnoDB';
                $table->string('nombre');
                $table->string('telefonos')->nullable();
                $table->string('email')->nullable();
                $table->string('sector')->nullable();
                $table->bigInteger('cliente_id')->unsigned();
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
        Schema::dropIfExists('contacto_cliente');
    }
}
