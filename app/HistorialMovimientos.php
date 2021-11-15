<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialMovimientos extends Model
{
    protected $table = "historial_movimientos";

    protected $fillable = [
      'movimiento_id', 'fecha', 'estado'
    ];



    public function movimientos()
    {
        return $this->belongsTo(MovimientoDeposito::class,'movimiento_id','id');
    }


}
