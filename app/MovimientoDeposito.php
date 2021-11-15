<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimientoDeposito extends Model
{
    protected $table = "movimientos_deposito";

    protected $primaryKey = 'id';

    protected $fillable = [
      'idPedido','idDepositoDestino', 'idDepositoOrigen', 'idProducto','cantidad'
    ];

    public function depositoOrigen()
    {
        return $this->belongsTo(Deposito::class,'idDepositoOrigen','id');
    }

    public function depositoDestino()
    {
        return $this->belongsTo(Deposito::class,'idDepositoDestino','id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class,'idProducto','id');
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class,'idPedido','id');
    }

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }
}
