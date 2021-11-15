<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('monto');
            $table->string('vuelto');
            $table->string('forma');
            $table->string('observaciones');
            $table->bigInteger('pedido_id')->unsigned();
            $table->timestamps();
    
    
            $table->foreign('pedido_id')
                  ->references('id')
                  ->on('pedidos')
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
        Schema::dropIfExists('pagos');
    }
}
