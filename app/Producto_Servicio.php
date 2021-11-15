<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_Servicio extends Model
{
    protected $table = "productos_en_servicios";

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    
}
