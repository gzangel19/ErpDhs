<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    protected $table = "maquinarias";

    protected $fillable = [
      'modelo', 'numeroSerie', 'propiedad', 'estado','tipo','forma'
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }

    
}
