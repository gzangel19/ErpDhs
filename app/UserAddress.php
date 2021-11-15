<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = "user_direcciones";

    protected $hidden = ['created_at','updated_at'];

    public function provincia()
    {
        return $this->hasOne(Provincia::class,'id','provincia_id');
    }

}
