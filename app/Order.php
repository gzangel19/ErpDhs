<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $hidden = ['created_at','updated_at'];

    public function getItems(){

        return $this->hasMany(OrderItems::class,'order_id','id')->orderBy('product_name','ASC')->with(['getProduct']);

    }

    public function getUserAddress(){

        return $this->hasOne(UserAddress::class,'id','user_direcciones_id');

    }

    public function getUser(){

        return $this->hasOne(User::class,'id','user_id')->with(['getCliente']);

    }

    public function getTotal(){

        return $this->hasMany(OrderItems::class,'order_id','id')->orderBy('product_name','ASC')->with(['getProduct'])->sum('subTotal');

    }
}
