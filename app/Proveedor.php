<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedores";

    protected $fillable = [
      'nombre','razon_Social','cuit_cuil','datoBancario' ,'telefonos', 'email', 'direccion', 'ciudad', 'codigo_postal', 'provincia_id', 'rubro_id'
    ];

    public function rubro()
    {
        return $this->belongsTo(Rubro::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function unidades_negocios()
    {
        return $this->belongsToMany(Unidad_Negocio::class,'proveedores_unidad_negocio','proveedor_id','unidadnegocio_id');
    }

    public function contactos()
  {
      return $this->hasMany(ContactoProveedor::class);
  }

    
}
