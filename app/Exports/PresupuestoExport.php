<?php

namespace App\Exports;

use App\Presupuesto;
use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class PresupuestoExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStyles,WithTitle,WithStrictNullComparison
{
    public function headings(): array
    {
        return [
            'Numero',
            'Cliente',
            'Vendedor',
            'Fecha',
            'Total',
            'Tipo'
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
        ];

    }


    public function title(): string
    {
        return 'Reporte de Presupuesto';
    }


    public function collection()
    {
        return $presupuestos = DB::table('presupuestos as presupuesto')
        ->join('clientes as cli','presupuesto.cliente_id','=','cli.id')
        ->join('users as usu','presupuesto.usuario_id','=','usu.id')
        ->select('presupuesto.num_comprobante','cli.nombre_Fantasia as cliente','usu.nombre as vendedor','presupuesto.fecha','presupuesto.total','presupuesto.tipo')
        ->orderBy('presupuesto.id', 'DESC')
        ->get();
    }
}
