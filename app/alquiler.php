<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;


class alquiler extends Model
{
    protected $table = "alquileres";

    protected $fillable = [
        'cliente_id','maquinaria_id','fecha','fechaBaja','estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id','id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }

    public function maquina()
    {
        return $this->belongsTo(Maquinaria::class,'maquinaria_id','id');
    }

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
    
    public function calcularDias($diaInicio,$diaFinal) {
        
        $mytime = \Carbon\Carbon::now('America/Argentina/Tucuman');
        
        //$fecha1 = new DateTime($mytime->toDateTimeString());

        $fecha1 = new DateTime($diaFinal);

        $fecha2 = new DateTime($diaInicio);
        
        $resultado = $fecha2->diff($fecha1);
        
        return $resultado->format('%d');

    }
    
}
