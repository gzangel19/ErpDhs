<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameComisiones extends Migration
{
    public function up()
    {
        Schema::rename('comisiones', 'detalle_comisiones');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('detalle_comisiones', 'comisiones');
    }
}
