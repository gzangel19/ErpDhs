<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Compra extends Model
{
    protected $table = "detalle_compras";

    protected $primaryKey = 'id';

    protected $fillable = [
      'pedido_id', 'producto_id', 'cantidad','precio'
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
