<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Historial_Producto_Servicio;
use App\Producto;
use App\Servicio;

class Producto_en_Servicio extends Model
{
    protected $table = "productos_en_servicios";
    protected $primaryKey = 'idProductos_en_servicios';

    public function scopeBuscarProducto($query,$id){
        
        if (trim($id)!= "") {
            $query->join('productos', 'productos_en_servicios.productos_idProductos', '=', 'productos.idProductos')
            ->join('mov_productos_servicios', 'productos_en_servicios.idProductos_en_servicios', '=', 'mov_productos_servicios.FK_idProductos_en_servicios')
            ->join('servicios', 'servicios.idServicios', '=', 'mov_productos_servicios.FK_servicios_idServicios')
            ->select('productos_en_servicios.*','productos.nombre as prod_nombre', 'productos.*','servicios.nombre as serv_nombre','servicios.*')
            ->where('numero_serie', 'LIKE', $id.'%');
        }else{
            $query->join('productos', 'productos_en_servicios.productos_idProductos', '=', 'productos.idProductos')
            ->join('mov_productos_servicios', 'productos_en_servicios.idProductos_en_servicios', '=', 'mov_productos_servicios.FK_idProductos_en_servicios')
            ->join('servicios', 'servicios.idServicios', '=', 'mov_productos_servicios.FK_servicios_idServicios')
            ->select('productos_en_servicios.*','productos.nombre as prod_nombre', 'productos.*','servicios.nombre as serv_nombre','servicios.*');
        }  	
    }


    public function scopeObtenerProducto($query,$id){
        $query->join('productos', 'productos_en_servicios.productos_idProductos', '=', 'productos.idProductos')
        ->select('productos_en_servicios.*','productos.nombre as prod_nombre', 'productos.*')
        ->where('productos_en_servicios.idProductos_en_servicios','=',1);
    }

    //relaacion 1:N
    public function historialesProductosServicios()
    {
        return $this->hasMany(Historial_Producto_Servicio::class ,'idProd_en_serv','idProductos_en_servicios');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class,'productos_idProductos','idProductos');
    }

    //relacion N:M
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class,'mov_productos_servicios','FK_idProductos_en_servicios','FK_servicios_idServicios');
    }
}
