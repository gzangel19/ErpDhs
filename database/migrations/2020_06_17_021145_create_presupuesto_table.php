<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuesto', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('usuario_id')->unsigned();
            $table->string('num_comprobante');
            $table->enum('tipo', ['Pesos', 'Dolares'])->default('Pesos');
            $table->string('fecha');
            $table->string('total');
            $table->enum('estado', ['Pendiente', 'Aprobado', 'Cancelado'])->default('Pendiente');
            $table->timestamps();

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
        Schema::dropIfExists('presupuesto');
    }
}
