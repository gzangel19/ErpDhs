<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositosProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposito_producto', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('stock')->default(0);
            $table->integer('stock_reservado')->default(0);
            $table->integer('stock_enflete')->default(0);
            $table->integer('stock_critico')->default(0);
            $table->string('ubicacion')->nullable();
            $table->bigInteger('producto_id')->unsigned();
            $table->bigInteger('deposito_id')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('depositos_productos');
    }
}
