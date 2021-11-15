<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $dates = ['deleted_at'];

    protected $fillable = [
      'nombre_Fantasia','razon_Social','cuit_cuil', 'telefonos', 'email', 'direccion', 'ciudad', 'codigo_postal', 'genero', 'tipo', 'provincia_id', 'rubro_id'
    ];

    public function rubro()
    {
        return $this->belongsTo(Rubro::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function maquinas()
    {
        return $this->hasMany(Maquinaria::class,'cliente_id','id');
    }

    public function fecha($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class,'cliente_id','id');
    }


}
