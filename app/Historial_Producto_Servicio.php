<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto_en_Servicio;

class Historial_Producto_Servicio extends Model
{
    protected $table = "historial_producto_en_servicio";
    protected $primaryKey = 'idHistorial_producto_en_servicio';
    
    public function productoEnServicio()
    {
        return $this->belongsTo(Producto_en_Servicio::class,'idProd_en_serv','idProductos_en_servicios');
    }
}
