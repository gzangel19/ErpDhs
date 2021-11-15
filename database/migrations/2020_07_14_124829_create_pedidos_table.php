<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('cliente_id')->unsigned();
            $table->bigInteger('usuario_id')->unsigned();
            $table->bigInteger('deposito_id')->unsigned();
            $table->string('num_pedido');
            $table->string('fecha');
            $table->string('tipo_entrega');
            $table->string('total');
            $table->string('tipo');
            $table->string('estado');
            $table->timestamps();

            $table->foreign('cliente_id')
                  ->references('id')
                  ->on('clientes')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('usuario_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

                  $table->foreign('deposito_id')
                  ->references('id')
                  ->on('depositos')
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
        Schema::dropIfExists('pedidos');
    }
}
