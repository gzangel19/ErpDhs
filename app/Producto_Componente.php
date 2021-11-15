<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_Componente extends Model
{
    protected $table = "producto_componente";

    protected $fillable = [
        'nombre','cantidad','costo','beneficio'
      ];

}
