<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Precio_Producto;
use App\Producto_en_Servicio;
use DateTime;

class Producto extends Model
{
    protected $table = "productos";

    protected $fillable = [
      'codigo', 'nombre', 'descripcion', 'imagen','img','costo_p', 'costo_d', 'p_flete_p', 'p_flete_d',
      'p_local_1p', 'p_local_1d', 'p_local_2p', 'p_local_2d', 'p_ml_p', 'p_ec_p', 'unidadnegocio_id'
    ];

    public function depositos()
    {
        return $this->belongsToMany(Deposito::class);
    }

    public function getInventario(){

        //$inventory = Unidad_Negocio::where('producto_id',$id)->get();
        return $this->hasMany(DepositoProducto::class,'producto_id','id');

        //return $inventory;
    }

    public function unidades_negocios()
    {
        return $this->belongsTo(Unidad_Negocio::class,'unidadnegocio_id','id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'categoria_id','id');
    }

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function calcular($value,$id) {
        
        $mytime = \Carbon\Carbon::now('America/Argentina/Tucuman');
        
        $fecha1 = new DateTime($mytime->toDateTimeString());

        $fecha2 = new DateTime($value);
        
        $resultado = $fecha2->diff($fecha1);
        
        return $resultado->format('%d');

    }


    
}
