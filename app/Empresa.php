<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = "clientes";

    protected $fillable = [
      'nombre', 'cuit_cuil', 'telefonos', 'email', 'pagina_web', 'domicilio', 'ciudad', 'codigo_postal', 'tipo', 'provincia_id', 'rubro_id'
    ];

    public function rubro()
    {
        return $this->belongsTo(Rubro::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
    ////////////////////////////////////

    public function unidades_negocios()
    {
        return $this->belongsToMany(Unidad_Negocio::class,'clientes_unidad_negocio','clientes_idClientes','unidad_negocio_idUnidad_negocio');
    }

    public function cedes()
    {
        return $this->hasMany(Cede::class,'cliente_id','id');
    }
}
