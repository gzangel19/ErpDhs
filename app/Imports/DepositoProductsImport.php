<?php

namespace App\Imports;

use App\DepositoProducto;
use Maatwebsite\Excel\Concerns\ToModel;

class DepositoProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DepositoProducto([
            'stock' => $row[3],
            'stock_critico' => $row[4],
            'ubicacion' => $row[5],
            'producto_id' => $row[0],
            'deposito_id' => $row[6]
        ]);
    }
}
