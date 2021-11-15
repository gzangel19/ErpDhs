<?php

namespace App\Exports;

use App\Pedido;
use Maatwebsite\Excel\Concerns\FromCollection;

use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class PedidosExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStyles,WithTitle,WithStrictNullComparison
{
    public function headings(): array
    {
        return [
            'Codigo',
            'Cliente',
            'Deposito',
            'Fecha',
            'Entrega',
            'Pago',
            'Total'
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
        ];

    }

    public function title(): string
    {
        return 'Reporte de Pedidos';
    }

    public function collection()
    {
        return  $pedidos =  DB::table('pedidos as pedido')
                    ->join('clientes','pedido.cliente_id','=','clientes.id')
                    ->join('depositos','pedido.deposito_id','=','depositos.id')
                    ->join('users','pedido.usuario_id','=','users.id')
                    ->select('pedido.num_pedido','clientes.razon_Social','depositos.nombre','pedido.fecha','pedido.fecha','pedido.estado','pedido.pago','pedido.total')
                    //->where('pedido.estado','not like','Cancelado')
                    ->orderBy('pedido.id','desc')
                    ->get();
    }
}
