<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cede;

class Servicio extends Model
{
    protected $table = "servicios";

    protected $fillable = [
        'cliente_id','ubicacion','modelo','numeroSerie' ,'tipo', 'estado'
    ];

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getFromhora($value) {
        return \Carbon\Carbon::parse($value)->format('H:i:s');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }

    public function maquina()
    {
        return $this->belongsTo(Maquinaria::class,'equipo_id','id');
    }

}
