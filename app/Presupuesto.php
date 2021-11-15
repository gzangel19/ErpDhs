<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Presupuesto extends Model
{
    protected $table = "presupuesto";


    protected $fillable = [
      'usuario_id','fecha','num_comprobante','total', 'estado'
    ];

    public function detalle_presupuesto()
    {
        return $this->hasMany(Detalle_Presupuesto::class,'presupuesto_id','id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }

    public function formatoHora($value) {
        return \Carbon\Carbon::parse($value)->format('H:i:s');
    }

    public function getFromhora($value) {
        return \Carbon\Carbon::parse($value)->format('H:i:s');
    }


}
