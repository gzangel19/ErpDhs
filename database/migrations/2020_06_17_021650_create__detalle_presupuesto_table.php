<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePresupuestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_presupuestos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('presupuesto_id')->unsigned();
            $table->bigInteger('producto_id')->unsigned();
            $table->string('cantidad');
            $table->string('precio');
            $table->string('tipo');
            $table->timestamps();

            $table->foreign('presupuesto_id')
                  ->references('id')
                  ->on('presupuesto')
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
        Schema::dropIfExists('_detalle_presupuesto');
    }
}
