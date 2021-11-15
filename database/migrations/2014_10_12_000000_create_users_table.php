<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('imagen_perfil')->nullable();
            $table->string('username',100)->unique();
            $table->string('password');
            $table->string('email')->nullable();
            $table->string('telefono_celular')->nullable();
            $table->string('telefono_fijo')->nullable();
            $table->string('domicilio')->nullable();
            $table->enum('pagina_principal', ['home','visor','ventas','administracion','tecnico','deposito',])->default('home');
            $table->enum('estado', ['activo','suspendido','baja',])->default('activo');
            $table->enum('tipo', ['cliente','usuario',])->default('cliente');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
