<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productos_numerados extends Model
{
    protected $table = "producto_numerados";

    protected $fillable = [
      'producto_id','numero','codigo','estado'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class,'producto_id');
    }
}
