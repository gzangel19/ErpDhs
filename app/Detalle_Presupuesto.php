<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Presupuesto extends Model
{
    protected $table = "detalle_presupuestos";

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
      'presupuesto_id', 'producto_id', 'cantidad','precio'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
