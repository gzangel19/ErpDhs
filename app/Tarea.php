<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = "tareas";

    protected $fillable = [
      'detalle', 'estado', 'prioridad', 'fecha_inicio', 'fecha_fin', 'tipo_tarea_id'
    ];



    //Relacion con Tipo de Tarea

    public function tipotarea()
    {
        return $this->belongsTo('App\Tipo_Tarea');
    }

    // Relacion con Movimientos de Tareas

    public function movimientos()
    {
        return $this->hasMany('App\Movimiento_Tarea');
    }

    public function pedido()
    {
        return $this->hasOne(Pedido::class,'id','pedido_id');
    }
    
    public function order()
    {
        return $this->hasOne(Order::class,'id','orden_id');
    }
}
