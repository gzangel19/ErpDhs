<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_comision extends Model
{
    protected $table = "detalle_comisiones";


    protected $fillable = [
      'usuario_id','fecha','procentaje','montoBonus','valorBonus','totalComisiones','totalBonus','totalVenta','monto','estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
}
