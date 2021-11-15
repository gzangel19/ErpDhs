<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dolar extends Model
{
    protected $table = "dolares";

    protected $primaryKey = 'id';

    protected $fillable = [
      'valor'
    ];
}
