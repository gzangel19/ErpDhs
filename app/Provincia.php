<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Unidad_Negocio;

class Provincia extends Model
{
  protected $table = "provincias";

  protected $fillable = [
      'nombre'
  ];

  public function unidadesdenegocio()
  {
      return $this->hasMany(Unidad_Negocio::class);
  }

  public function clientes()
  {
      return $this->hasMany(Cliente::class);
  }

  public function empresas()
  {
      return $this->hasMany(Empresa::class);
  }

  public function depositos()
  {
      return $this->hasMany(Deposito::class);
  }

  public function proveedores()
  {
      return $this->hasMany(Proveedor::class);
  }
}
