<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('nombre_Fantasia');
            $table->string('razon_Social');
            $table->string('cuit_cuil')->nullable();
            $table->string('telefonos')->nullable();
            $table->string('email')->nullable();
            $table->string('pagina_web')->nullable();
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->enum('genero', ['masculino', 'femenino', 'otro'])->default('otro');
            $table->enum('tipo', ['persona', 'empresa'])->default('persona');
            $table->enum('facturacion', ['Si', 'No'])->default('Si');
            $table->bigInteger('provincia_id')->unsigned();
            $table->bigInteger('rubro_id')->unsigned();
            $table->timestamps();

            $table->foreign('provincia_id')
                  ->references('id')
                  ->on('provincias')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('rubro_id')
                  ->references('id')
                  ->on('rubros')
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
        Schema::dropIfExists('clientes');
    }
}
