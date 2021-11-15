<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = "pagos";

    public function getFromDateAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y H:i:s');
    }
}

