<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = "compras";


    protected $fillable = [
      'proveedor_id','usuario_id','deposito_id','num_compra','fecha','totalPesos','totalDolares' ,'imagenFactura'
    ];

    public function detalle_compra()
    {
        return $this->hasMany(Detalle_Compra::class,'compra_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function deposito()
    {
        return $this->belongsTo(Deposito::class,'deposito_id');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class,'proveedor_id');
    }
}
