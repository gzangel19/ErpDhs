<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Pagos extends Model
{
    protected $table = "detalle_pagos";

    protected $fillable = [
      'pagos_id','fecha','monto'
    ];

    public function getFromDateAttribute($value) {
      return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function pago()
    {
        return $this->hasOne(Pagos_Cuenta::class,'id','pagos_id');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class,'id','cliente_id');
    }

}
