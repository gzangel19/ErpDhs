<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Producto;
use DB;

class DepositoProductoExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $id;

    public function __construct(int $id)
    {
       $this->id = $id;
    }

    public function headings():array{
        return [
            '#',
            'Codigo',
            'Producto',
            'Stock Disponible',
            'Stock Critico',
            'Ubicacion',
            'Nº Deposito'
        ];
    }

    public function collection()
    {
        return DB::table('productos')->select('id','codigo','nombre')->whereNotExists(function($query){
            $query->select(DB::raw(1))->from('deposito_producto')->whereRaw('deposito_producto.producto_id = productos.id');
        })->get();
    }

}
