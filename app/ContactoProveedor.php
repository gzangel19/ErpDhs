<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactoProveedor extends Model
{
  protected $table = "contacto_proveedor";

  protected $fillable = [
    'nombre', 'telefonos', 'email', 'sector'
  ];
}
