<?php

namespace App;
use DateTime;

use Illuminate\Database\Eloquent\Model;

class Pagos_Cuenta extends Model
{
    protected $table = "pagos_cuentas";


    protected $fillable = [
      'pedido_id','montoRestante','estado'
    ];

    public function detalle_pagos()
    {
        return $this->hasMany(Detalle_Pagos::class,'pagos_id','id');
    }

    public function pedido()
    {
        return $this->hasOne(Pedido::class,'id','pedido_id');
    }

    public function producto()
    {
        return $this->hasOne(Producto::class,'id','producto_id');
    }

    public function calcularDias($value) {

       
      $mytime = \Carbon\Carbon::now('America/Argentina/Tucuman');
      
      $fecha1 = new DateTime($mytime->toDateTimeString());

      $fecha2 = new DateTime($value);
      
      $resultado = $fecha2->diff($fecha1);
      
      return $resultado->format('%d');

  }

  public function getFromDateAttribute($value) {
    return \Carbon\Carbon::parse($value)->format('d/m/Y');
  }

}
