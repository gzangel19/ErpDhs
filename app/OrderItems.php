<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'carrito';

    protected $hidden = ['created_at','updated_at'];

    public function getProduct(){
        return $this->hasOne(Producto::class,'id','producto_id');
    }
}
