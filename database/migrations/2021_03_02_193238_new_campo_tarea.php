<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewCampoTarea extends Migration
{

    public function up()
    {
        Schema::table('tareas', function (Blueprint $table) {
            $table->bigInteger('pedido_id')->default(0);
            $table->bigInteger('servicio_id')->default(0);
        });
    }


    public function down()
    {
        Schema::table('tareas', function (Blueprint $table) {
            //
        });
    }
}
