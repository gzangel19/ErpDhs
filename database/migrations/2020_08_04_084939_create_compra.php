<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('proveedor_id')->unsigned();
            $table->bigInteger('usuario_id')->unsigned();
            $table->bigInteger('deposito_id')->unsigned();
            $table->string('num_compra');
            $table->string('fecha');
            $table->string('total');
            $table->string('tipo');
            $table->string('imagenFactura')->nullable();
            $table->timestamps();

            $table->foreign('proveedor_id')
                  ->references('id')
                  ->on('proveedores')
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
        Schema::dropIfExists('compra');
    }
}
