<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaProductoNumerados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_numerados', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('producto_id')->unsigned();
            $table->bigInteger('pedido_id');
            $table->integer('numero');
            $table->string('codigo');
            $table->string('estado')->default('En Deposito');

            $table->foreign('producto_id')
                  ->references('id')
                  ->on('productos')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_numerados');
    }
}
