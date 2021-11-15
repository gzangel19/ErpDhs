<?php

namespace App\Exports;

use App\Cliente;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;


class ClienteExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStyles,WithTitle,WithStrictNullComparison
{
    public function headings(): array
    {
        return [
            'Nombre',
            'Razon Social',
            'Cuil/Cuit',
            'Telefono',
            'E-Mail',
            'Genero',
            'Direccion',
            'Ciudad',
            'Provincia',
            'Tipo de Cliente',
            'Rubro'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1' => ['font'  => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
            'B1' => ['font' => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
            'C1' => ['font' => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
            'D1' => ['font' => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
            'E1' => ['font' => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
            'F1' => ['font' => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
            'G1' => ['font' => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
            'H1' => ['font' => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
            'I1' => ['font' => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
            'J1' => ['font' => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
            'K1' => ['font' => ['italic' => true,'size'  => 12,'bold' => true,'color' => array('rgb' => 'FF0000')]],
        ];

    }


    public function title(): string
    {
        return 'Reporte de Clientes';
    }


    public function collection()
    {
        return $clientes = DB::table('clientes as cliente')
        ->join('provincias as pro','cliente.provincia_id','=','pro.id')
        ->join('rubros as rub','cliente.rubro_id','=','rub.id')
        ->select('cliente.nombre_Fantasia','cliente.razon_Social','cliente.cuit_cuil','cliente.telefonos','cliente.email','cliente.genero','cliente.direccion','cliente.ciudad','pro.nombre as provincia','cliente.tipo','rub.nombre as rubro')
        ->orderBy('cliente.nombre_Fantasia', 'ASC')
        ->get();
    }
}
