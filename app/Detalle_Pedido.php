<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Pedido extends Model
{
    protected $table = "detalle_pedido";

    protected $primaryKey = 'id';

    protected $fillable = [
      'pedido_id','deposito_id', 'producto_id', 'cantidad','precio','estado'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function deposito()
    {
        return $this->belongsTo(Deposito::class);
    }
}
