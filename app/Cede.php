<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cliente;
use App\Servicio;

class Cede extends Model
{
    protected $table = "cedes";

    //relacion para acceder al cliente 

    public function cliente()
    {
        return $this->belongsTo(Cliente::class,'cliente_id','id');
    }

    //relaacion 1:N
    public function servicios()
    {
        return $this->hasMany(Servicio::class,'cedes_idCedes','idCedes');
    }
}
