<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = "movimientos";

    protected $primaryKey = 'id';

    protected $fillable = [
      'fecha','depositoDestino_id', 'depositoOrigen_id'
    ];

    public function depositoOrigen()
    {
        return $this->belongsTo(Deposito::class,'depositoOrigen_id','id');
    }

    public function depositoDestino()
    {
        return $this->belongsTo(Deposito::class,'depositoDestino_id','id');
    }

    public function movimientoDepositos()
    {
        return $this->hasMany(MovimientoDeposito::class,'idMovimiento','id');
    }

    public function fechaFormato($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }
}
