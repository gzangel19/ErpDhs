<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    protected $table = "presupuestos_compras";


    protected $fillable = [
      'proveedor_id','usuario_id','num_comprobante','fecha','total', 'estado','tipò'
    ];

    public function detalle_PresupuestoCompra()
    {
        return $this->hasMany(Detalle_PresupuestoCompra::class,'presupuestos_compras_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class,'proveedor_id','id');
    }

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }
}
