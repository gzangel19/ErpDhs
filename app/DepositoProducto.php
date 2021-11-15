<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepositoProducto extends Model
{
  protected $table = "deposito_producto";

  protected $fillable = [
    'stock', 'stock_reservado', 'stock_critico', 'ubicacion', 'producto_id', 'deposito_id'
  ];


  public function getProducto($id)
  {
    $producto = Producto::findOrFail($id);

    return $producto;
  }

  public function getDeposito($id)
  {
    $deposito = Deposito::findOrFail($id);

    return $deposito;
  }


}
