<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_PresupuestoCompra extends Model
{
    protected $table = "detalle_presupuesto_compra";

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
      'presupuesto_compra_id', 'producto_id', 'cantidad','precio'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
