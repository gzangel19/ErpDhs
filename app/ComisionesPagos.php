<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComisionesPagos extends Model
{
    protected $table = "comisiones_pagos";


    protected $fillable = [
      'usuario_id','totalVendido','porcentajeVenta','bonus','montoBonus','comision','fechaDesde','fechaHasta','mes','estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
}
