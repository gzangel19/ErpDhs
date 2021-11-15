<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento_Tarea extends Model
{
    protected $table = "movimientos_tareas";

    protected $fillable = [
      'observaciones', 'fecha_movimiento', 'tarea_id', 'user_id'
    ];



    // Relacion con Tarea

    public function tarea()
    {
        return $this->belongsTo('App\Tarea');
    }


    // Relacion con Usuarios

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
