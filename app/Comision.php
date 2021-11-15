<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    protected $table = "comisiones";


    protected $fillable = [
      'usuario_id','porcentaje','bonus','valorBonus'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
}
