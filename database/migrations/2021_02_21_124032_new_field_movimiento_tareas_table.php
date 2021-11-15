<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewFieldMovimientoTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movimientos_tareas', function (Blueprint $table) {
            $table->bigInteger('venta_id')->default(0);
            $table->bigInteger('servicio_id')->default(0);
            $table->bigInteger('compra_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimientos_tareas', function (Blueprint $table) {
            //
        });
    }
}
