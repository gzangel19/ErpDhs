<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposito extends Model
{
  protected $table = "depositos";

  protected $dates = ['deleted_at'];

  protected $fillable = [
    'nombre', 'telefonos', 'direccion', 'ciudad', 'codigo_postal', 'provincia_id'
  ];

  public function provincia()
  {
      return $this->belongsTo(Provincia::class);
  }

  public function getInventario(){

      return $this->hasMany(DepositoProducto::class,'deposito_id','id');

  }

  public function getProducto($id)
  {
    $producto = Producto::findOrFail($id);

    return $producto;
  }
  

}
