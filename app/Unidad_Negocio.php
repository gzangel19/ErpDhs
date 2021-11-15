<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Cliente;
use App\Servicio;
use App\Provincia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidad_Negocio extends Model
{
    protected $table = "unidad_negocio";

    protected $dates = ['deleted_at'];


    protected $fillable = [
        'nombre', 'direccion', 'telefonos', 'cuit', 'ciudad', 'codigo_postal', 'provincia_id'
    ];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }


    public function clientes()
    {
        return $this->belongsToMany(Cliente::class,'clientes_unidad_negocio','unidadnegocio_id','cliente_id');
    }


    /////////////////////////////////////

    //relacion N:M
    public function users()
    {
        return $this->belongsToMany(User::class,'unidad_negocio_usuario','unidadnegocio_id','usuario_id');
    }





    //relaacion 1:N
    public function servicios()
    {
        return $this->hasMany(Servicio::class,'unidad_negocio_idUnidad_negocio','idUnidad_Negocio');
    }
}
