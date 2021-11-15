<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_pedido', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->bigIncrements('id');
        $table->bigInteger('pedido_id')->unsigned();
        $table->bigInteger('producto_id')->unsigned();
        $table->bigInteger('deposito_id')->unsigned();
        $table->string('cantidad');
        $table->string('precio');
        $table->string('estado');
        $table->timestamps();


        $table->foreign('pedido_id')
              ->references('id')
              ->on('pedidos')
              ->onUpdate('cascade')
              ->onDelete('cascade');

        $table->foreign('producto_id')
              ->references('id')
              ->on('productos')
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
        Schema::dropIfExists('detalle_pedido');
    }
}
