<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Tarea extends Model
{
    protected $table = "tipos_tareas";

    protected $fillable = [
      'nombre'
    ];


    
    // Relacion con Tareas

    public function tareas()
    {
        return $this->hasMany('App\Tarea');
    }


}
