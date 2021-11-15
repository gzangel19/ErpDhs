<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pedido;

class MovimientoCaja extends Model
{
    protected $table = "movimiento_caja";

    protected $fillable = [
        'cajas_id',
        'descripcion',
        'entrada',
        'salida'
    ];

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getDia($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }

    public function getFromDay($value) {
        return \Carbon\Carbon::parse($value)->format('H:i:s');
    }

    
}
