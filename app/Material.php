<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = "materias_primas";


    protected $fillable = [
      'descripcion','detalle','imagen','costo','moneda'
    ];
    
}
