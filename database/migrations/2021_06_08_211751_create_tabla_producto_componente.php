<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaProductoComponente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_componente', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('producto_id')->unsigned();
                $table->string('nombre');
                $table->string('cantidad');
                $table->string('costo');
                $table->string('beneficio');
                $table->timestamps();
        
                $table->foreign('producto_id')
                      ->references('id')
                      ->on('productos')
                      ->onUpdate('cascade')
                      ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('producto_componente');
    }
}
