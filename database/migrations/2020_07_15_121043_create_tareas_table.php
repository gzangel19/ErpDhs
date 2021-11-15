<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('detalle')->nullable();
            $table->enum('estado', ['pendiente', 'en_proceso', 'suspedida','finalizada'])->default('pendiente');
            $table->enum('prioridad', ['normal', 'urgencia'])->default('normal');
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_fin')->nullable();
            $table->bigInteger('tipo_tarea_id')->unsigned();
            $table->timestamps();

            $table->foreign('tipo_tarea_id')
                  ->references('id')
                  ->on('tipos_tareas')
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
        Schema::dropIfExists('tareas');
    }
}
