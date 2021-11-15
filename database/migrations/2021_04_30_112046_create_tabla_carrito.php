<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaCarrito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('usuario_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->bigInteger('deposito_id')->unsigned();
            $table->string('cantidad');
            $table->string('precio');
            $table->string('subTotal');
            $table->timestamps();
    
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
        Schema::dropIfExists('carrito');
    }
}
