<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto_Material extends Model
{
    protected $table = "productos_material";

    protected $fillable = [
      'id', 'producto_id', 'material_id', 'cantidad'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class,'material_id','id');
    }

}
