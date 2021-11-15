<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cajas extends Model
{
    protected $table = "cajas";

    protected $fillable = [
        'nombre',
        'estado'
    ];

    public function deposito()
    {
        return $this->hasOne(Deposito::class,'id','deposito_id');
    }
}
