<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewFieldDetalleComisiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalle_comisiones', function (Blueprint $table) {
            $table->integer('porcentaje');
            $table->string('montoBonus');
            $table->string('valorBonus');
            $table->string('totalComision');
            $table->string('totalBonus');
            $table->string('totalVenta');
            $table->string('totalPorcentaje');
        });
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_comisiones', function (Blueprint $table) {
            //
        });
    }
}
