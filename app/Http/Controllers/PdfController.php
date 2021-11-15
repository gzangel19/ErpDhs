<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Cliente;
use App\Presupuesto;
use App\Deposito;
use App\Detalle_Pedido;
use App\Pagos_Cuenta;
use App\Pedido;
use App\Cajas;
use App\Producto;
use App\Detalle_Pagos;
use App\MovimientoCaja;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function listadoEmpresas()
    {
        $empresas = Empresa::where('tipo','like','Empresa')->get();

        $pdf = PDF::loadView('pdf.empresaspdf',['empresas'=>$empresas]);

        return $pdf->stream();
    }

    public function listadoClientes()
    {
        $clientes = Cliente::where('tipo','like','persona')->get();

        $pdf = PDF::loadView('pdf.clientespdf',['clientes'=>$clientes]);
    
        return $pdf->stream();
    }

    public function listadoDepositos()
    {
        $depositos = Deposito::get();

        $pdf = PDF::loadView('pdf.depositospdf',compact('depositos'))->setPaper('a4', 'landscape');
    
        return $pdf->stream();
    }

    public function presupuesto ($id)
    {
        $presupuesto = Presupuesto::find($id);;

        $detalle = $presupuesto->detalle_presupuesto()->get();

        $pdf = PDF::loadView('pdf.presupuestopdf',['presupuesto'=>$presupuesto],['detalle'=>$detalle])->setPaper('a4', 'landscape');
    
        return $pdf->stream();
    }

    public function movimientoPedido($id)
    {
        $pedido = Pedido::find($id);;

        $detalle = $pedido->detalle_pedido()->get();

        $pdf = PDF::loadView('pdf.solicitudMovimientoPedidopdf',['presupuesto'=>$pedido],['detalle'=>$detalle])->setPaper('a4','portrait');
    
        return $pdf->stream();
    }

    public function imprimirRemito($id)
    {
        $pedido = Pedido::find($id);

        $detalle = $pedido->detalle_pedido()->get();
        
        $cotizacion = Detalle_Pedido::select('cotizacion')->where('pedido_id','like',$id)->firstOrFail();

        $totalDolares = Detalle_Pedido::select(DB::raw('sum(cantidad*precioDolares) as total'))
        ->where('pedido_id','=',$id)
        ->firstOrFail();

        $totalPesos = Detalle_Pedido::select(DB::raw('sum(cantidad*precio) as totalP'))
        ->where('pedido_id','=',$id)
        ->firstOrFail();

        $suma = $pedido->detalle_pedido()->sum(DB::raw('cantidad * precio'));

        $image =  \QrCode::size(100)->generate('https://web.facebook.com/dhstienda');
        
        $pdf = PDF::loadView('pdf.remitoXentrega',compact('image','pedido','detalle','cotizacion','totalDolares','totalPesos','suma'))->setPaper('a4','portrait');
    
        return $pdf->stream();
    }

    public function historialPagos($id)
    {
        $pago = Pagos_Cuenta::find($id);


        $historial = Detalle_Pagos::where('pagos_id','=',$id)
                                    ->orderBy('id', 'desc')
                                    ->get(); 
        
        $cliente = Cliente::find($pago->cliente_id);
        
        $pdf = PDF::loadView('pdf.historialpagos',compact('pago','historial','cliente'))->setPaper('a4','portrait');
    
        return $pdf->stream();
    }


    public function imprimirReciboComprobante($id){

        $historial = Detalle_Pagos::find($id);

        $cajas = Cajas::find(1);

        $pago = Pagos_Cuenta::find($historial->pagos_id);

        $cliente = Cliente::find($pago->cliente_id);

        $pedido = Pedido::find($pago->pedido_id);

        $pesos = $historial->montop;

        $dolaresP = $historial->monto * $historial->cotizacion;

        $pdf = PDF::loadView('pdf.comprobante',compact('historial','pesos','dolaresP','cliente','pedido','cajas'))->setPaper('a4','portrait');
    
        return $pdf->stream();

    }

    public function reporteCajaDiario(){

        $cajas = Cajas::find(Auth::user()->caja_id);

        $mytime = Carbon::now('America/Argentina/Tucuman');

        $dia = $mytime->toDateTimeString();
            
        $fechaApertura = MovimientoCaja::where('cajas_id','like',Auth::user()->caja_id)
            ->where('descripcion','like' ,'Apertura de Caja')
            ->orderBy('id','DESC')
            ->firstOrFail();

            $movimientos = MovimientoCaja::where('cajas_id','like',Auth::user()->caja_id)
            //->whereDate('created_at', '>=',$fechaApertura->created_at)
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia))
            ->where('descripcion','not like' ,'Cierre de Caja')
            ->orderBy('id','DESC')
            ->get();

            $efectivo = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja_id)
            ->where('tipo','like','Efectivo')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)   
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia))
            ->firstOrFail();

            $cheque = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja_id)
            ->where('tipo','like' ,'Cheque')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $transferencia = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja_id)
            ->where('tipo','like' ,'Transferencia Bancaria')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $mercado = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja_id)
            ->where('tipo','like' ,'Mercado Pago')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $tarjeta = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja_id)
            ->where('tipo','like' ,'tarjeta')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $ahora8 = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja_id)
            ->where('tipo','like' ,'Ahora8')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $ahora10 = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja_id)
            ->where('tipo','like' ,'Ahora10')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $ahora12 = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja_id)
            ->where('tipo','like' ,'Ahora12')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

        $pdf = PDF::loadView('pdf.reporteCajaDiaria',compact('fechaApertura','cajas','movimientos','efectivo','cheque','transferencia','mercado','tarjeta','ahora8','ahora10','ahora12'))->setPaper('a4','portrait');
    
        return $pdf->stream();
    }

    public function inventario($id){

        $deposito = Deposito::find($id);

        $productos = Producto::join('deposito_producto','productos.id','=','deposito_producto.producto_id')
        ->join('depositos','depositos.id','=','deposito_producto.deposito_id')
        ->select('productos.id','productos.codigo','productos.nombre','deposito_producto.stock as stock','deposito_producto.stock_critico as stockCritico','deposito_producto.ubicacion','deposito_producto.id as depositoId')
        ->where('depositos.id','=',$id)
        ->orderBy('productos.nombre','ASC')
        ->get();

        $pdf = PDF::loadView('pdf.inventario',compact('productos','deposito'))->setPaper('a4','landscape');
    
        return $pdf->stream();

    }

    
}