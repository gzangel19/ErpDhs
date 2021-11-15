<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialMaquinaria extends Model
{
    protected $table = "historial_maquinaria";

    protected $fillable = [
      'maquinaria_id', 'cliente_id', 'descripcion', 'fecha'
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }

    public function maquinarias()
    {
        return $this->belongsTo(Maquinaria::class,'maquinaria_id');
    }

}
