<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NuevoFieldPagoCuenta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos_cuentas', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->bigInteger('cliente_id')->unsigned();
            $table->string('montoRestantePesos');
            $table->string('moneda');
            //$table->timestamps();

            $table->foreign('cliente_id')
                  ->references('id')
                  ->on('clientes')
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
        Schema::table('pagos_cuentas', function (Blueprint $table) {
            //
        });
    }
}
