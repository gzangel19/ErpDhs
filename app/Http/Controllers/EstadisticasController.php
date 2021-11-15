<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Unidad_Negocio;
use App\Cajas;
use App\Dolar;
use App\Pedido;
use App\Cliente;
use App\Deposito;
use App\MovimientoCaja;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index()
    {
        $clientes = Cliente::orderBy('razon_Social', 'ASC')->get();
        $depositos = Deposito::orderBy('nombre', 'ASC')->get();
        $unidades = Unidad_Negocio::orderBy('id', 'ASC')->get();
        $productos = Producto::orderBy('nombre', 'ASC')->get();
        $cajas = Cajas::orderBy('nombre', 'ASC')->get();

        return view('estadisticas.index',compact('clientes','depositos','unidades','productos','cajas'));
        
    }

    public function clientes(Request $request){

        if($request->cliente_id == 0){
            
            $totalVentas = cliente::join('pedidos','clientes.id','=','pedidos.cliente_id')
            ->select('clientes.id','clientes.razon_Social',DB::raw('count(pedidos.id) as total'),DB::raw('sum(pedidos.total) as suma'))
            ->groupBy('clientes.id','clientes.razon_Social')
            ->orderBy('total','desc')                  
            ->get();

            return view('estadisticas.clientes',compact('totalVentas'));
        }
        else{
            
            $cliente = Cliente::find($request->cliente_id);

            $totalVentas = cliente::join('pedidos','clientes.id','=','pedidos.cliente_id')
            ->select('clientes.id','clientes.razon_Social',DB::raw('count(pedidos.id) as total'),DB::raw('sum(pedidos.total) as suma'))
            ->where('cliente_id','=',$request->cliente_id)
            ->groupBy('clientes.id','clientes.razon_Social')
            ->orderBy('total','desc')                  
            ->firstOrFail();

            $productosComprados = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
            ->join('pedidos','detalle_pedido.pedido_id','=','pedidos.id')
            ->select('productos.nombre',DB::raw('sum(detalle_pedido.cantidad) as total'))
            ->where('pedidos.cliente_id','=',$request->cliente_id)
            ->groupBy('productos.nombre')
            ->orderBy('total','desc')                   
            ->get();

            $ultimoPedido = Pedido::where('cliente_id','=',$request->cliente_id)->orderBy('id', 'desc')->firstOrFail();

            return view('estadisticas.cliente',compact('cliente','productosComprados','totalVentas','ultimoPedido'));
        }

    }

    public function cliente($id){
                        
            $cliente = Cliente::find($id);

            $totalVentas = cliente::join('pedidos','clientes.id','=','pedidos.cliente_id')
            ->select('clientes.id','clientes.razon_Social',DB::raw('count(pedidos.id) as total'),DB::raw('sum(pedidos.total) as suma'))
            ->where('cliente_id','=',$id)
            ->groupBy('clientes.id','clientes.razon_Social')
            ->orderBy('total','desc')                  
            ->firstOrFail();

            $productosComprados = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
            ->join('pedidos','detalle_pedido.pedido_id','=','pedidos.id')
            ->select('productos.nombre',DB::raw('count(detalle_pedido.id) as total'))
            ->where('pedidos.cliente_id','=',$id)
            ->groupBy('productos.nombre')
            ->orderBy('total','desc')                   
            ->get();

            $ultimoPedido = Pedido::where('cliente_id','=',$id)->orderBy('id', 'desc')->firstOrFail();

            return view('estadisticas.cliente',compact('cliente','productosComprados','totalVentas','ultimoPedido'));
    }

    public function productos(Request $request)
    {
        $id = $request->producto_id;
        
        if( $id == 0){
            
            $totalProductos = Producto::all()->count();

            $productosMasVendidos = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
            ->select('productos.id','productos.nombre',DB::raw('sum(detalle_pedido.cantidad) as cantidad'),DB::raw('count(detalle_pedido.id) as total'),DB::raw('sum(detalle_pedido.cantidad * detalle_pedido.precio ) as suma'))
            ->groupBy('productos.id','productos.nombre')
            ->orderBy('total','desc')
            ->where('productos.nombre','not like','Envio Zona 1')
            ->where('productos.nombre','not like','Envio Zona 2')
            ->where('productos.nombre','not like','Envío Zona 3 MINIMO')
            ->limit(15)
            ->get();
    
            $cantidadProductosMasVendidos = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
            ->select('productos.id','productos.nombre',DB::raw('sum(detalle_pedido.cantidad) as cantidad'),DB::raw('count(detalle_pedido.id) as total'),DB::raw('sum(detalle_pedido.cantidad * detalle_pedido.precio ) as suma'))
            ->groupBy('productos.id','productos.nombre')
            ->orderBy('cantidad','desc')
            ->where('productos.nombre','not like','Envio Zona 1')
            ->where('productos.nombre','not like','Envio Zona 2')
            ->where('productos.nombre','not like','Envío Zona 3 MINIMO')
            ->limit(15)
            ->get();
    
            return view('estadisticas.productos',compact('productosMasVendidos','totalProductos','cantidadProductosMasVendidos'));
            
        }
        else{
            $producto = Producto::find($id);

            $totalVentas = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
             ->join('pedidos','detalle_pedido.pedido_id','=','pedidos.id')
             ->select(DB::raw('count(detalle_pedido.id) as total'),DB::raw('sum(detalle_pedido.cantidad) as cantidad'),DB::raw('sum(detalle_pedido.cantidad * detalle_pedido.precio ) as suma'),DB::raw('sum(detalle_pedido.cantidad * detalle_pedido.precioDolares ) as dolares'))
             ->where('productos.id','=',$id)
             ->orderBy('total','desc')                   
             ->firstOrFail();
    
            $detalleVentas = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
             ->join('pedidos','detalle_pedido.pedido_id','=','pedidos.id')
             ->join('clientes','pedidos.cliente_id','=','clientes.id')
             ->select('clientes.razon_Social',DB::raw('sum(detalle_pedido.cantidad) as cantidad'),DB::raw('sum(detalle_pedido.cantidad * detalle_pedido.precio ) as suma'))
             ->where('productos.id','=',$id)
             ->groupBy('clientes.razon_Social')
             ->orderBy('cantidad', 'desc')
             ->get();  
    
             $stocks = Producto::join('deposito_producto','productos.id','=','deposito_producto.producto_id')
             ->join('depositos','depositos.id','=','deposito_producto.deposito_id')
             ->join('unidad_negocio','productos.unidadnegocio_id','=','unidad_negocio.id')
             ->select('productos.id','deposito_producto.stock as stock','depositos.nombre as deposito')
             ->where('productos.id','=',$id)
             ->orderBy('depositos.nombre','ASC')
             ->orderBy('productos.nombre','ASC')
             ->get();
    
            $ultimoPedido = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
            ->join('pedidos','detalle_pedido.pedido_id','=','pedidos.id')
            ->join('clientes','pedidos.cliente_id','=','clientes.id')
            ->select('clientes.razon_Social',DB::raw('count(detalle_pedido.id) as total'))
            ->where('productos.id','=',$id)
            ->groupBy('clientes.razon_Social')
            ->orderBy('detalle_pedido.id', 'desc')
            ->firstOrFail();        
    
            return view('estadisticas.producto',compact('producto','totalVentas','ultimoPedido','detalleVentas','stocks'));
        }

    }

    public function producto($id){
                        
        $producto = Producto::find($id);

        $totalVentas = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
         ->join('pedidos','detalle_pedido.pedido_id','=','pedidos.id')
         ->select(DB::raw('count(detalle_pedido.id) as total'),DB::raw('sum(detalle_pedido.cantidad) as cantidad'),DB::raw('sum(detalle_pedido.cantidad * detalle_pedido.precio ) as suma'),DB::raw('sum(detalle_pedido.cantidad * detalle_pedido.precioDolares ) as dolares'))
         ->where('productos.id','=',$id)
         ->orderBy('total','desc')                   
         ->firstOrFail();

        $detalleVentas = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
         ->join('pedidos','detalle_pedido.pedido_id','=','pedidos.id')
         ->join('clientes','pedidos.cliente_id','=','clientes.id')
         ->select('clientes.razon_Social',DB::raw('sum(detalle_pedido.cantidad) as cantidad'),DB::raw('sum(detalle_pedido.cantidad * detalle_pedido.precio ) as suma'))
         ->where('productos.id','=',$id)
         ->groupBy('clientes.razon_Social')
         ->orderBy('cantidad', 'desc')
         ->get();  

         $stocks = Producto::join('deposito_producto','productos.id','=','deposito_producto.producto_id')
         ->join('depositos','depositos.id','=','deposito_producto.deposito_id')
         ->join('unidad_negocio','productos.unidadnegocio_id','=','unidad_negocio.id')
         ->select('productos.id','deposito_producto.stock as stock','depositos.nombre as deposito')
         ->where('productos.id','=',$id)
         ->orderBy('depositos.nombre','ASC')
         ->orderBy('productos.nombre','ASC')
         ->get();

        $ultimoPedido = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
        ->join('pedidos','detalle_pedido.pedido_id','=','pedidos.id')
        ->join('clientes','pedidos.cliente_id','=','clientes.id')
        ->select('clientes.razon_Social',DB::raw('count(detalle_pedido.id) as total'))
        ->where('productos.id','=',$id)
        ->groupBy('clientes.razon_Social')
        ->orderBy('detalle_pedido.id', 'desc')
        ->firstOrFail();        

        return view('estadisticas.producto',compact('producto','totalVentas','ultimoPedido','detalleVentas','stocks'));
    }



    public function cajas(Request $request)
    {
        $searchText = $request->searchText;

        $ultimo = $request->searchTextHasta;

        if($searchText){
            $cajas = Cajas::join('movimiento_caja','cajas.id','=','movimiento_caja.cajas_id')
            ->select('cajas.id','cajas.nombre',DB::raw('sum(movimiento_caja.entrada) as entrada'),DB::raw('sum(movimiento_caja.salida) as salida'),DB::raw('sum(movimiento_caja.saldoParcialDolares) as dolares'))
            ->whereDate('movimiento_caja.created_at','>=',$searchText) 
            ->whereDate('movimiento_caja.created_at','<=',$ultimo) 
            ->groupBy('cajas.id','cajas.nombre')
            ->orderBy('cajas.nombre', 'desc')
            ->get(); 

            return view('estadisticas.cajas', compact('cajas','searchText','ultimo'));
        }
        else{
            return view('estadisticas.cajaShowMes');
        }

    }

    public function caja($id,$desde,$hasta)
    {
            $cajas = Cajas::find($id);

            $fechaApertura = MovimientoCaja::where('cajas_id','like',$id)
            ->where('descripcion','like' ,'Apertura de Caja')
            ->orderBy('id','DESC')
            ->firstOrFail();
            
            $movimientos = MovimientoCaja::where('cajas_id','like',$id)
            //->whereDate('created_at', '>=',$fechaApertura->created_at)
            ->whereBetween('created_at', array($desde,$hasta))
            ->where('descripcion','not like' ,'Cierre de Caja')
            ->orderBy('id','DESC')
            ->get();

            $efectivo = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like','Efectivo')
            //->whereDate('created_at', '>=',$desde)   
            ->whereBetween('created_at', array($desde,$hasta))
            ->firstOrFail();

            $cheque = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Cheque')
            //->whereDate('created_at', '>=',$desde)  
            ->whereBetween('created_at', array($desde,$hasta)) 
            ->firstOrFail();

            $transferencia = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Transferencia Bancaria')
            //->whereDate('created_at', '>=',$desde)  
            ->whereBetween('created_at', array($desde,$hasta)) 
            ->firstOrFail();

            $mercado = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Mercado Pago')
            //->whereDate('created_at', '>=',$desde)  
            ->whereBetween('created_at', array($desde,$hasta)) 
            ->firstOrFail();

            $tarjeta = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'tarjeta')
            //->whereDate('created_at', '>=',$desde)  
            ->whereBetween('created_at', array($desde,$hasta)) 
            ->firstOrFail();

            $ahora6 = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Ahora6')
            //->whereDate('created_at', '>=',$desde)  
            ->whereBetween('created_at', array($desde,$hasta)) 
            ->firstOrFail();

            $ahora12 = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Ahora12')
            //->whereDate('created_at', '>=',$desde)  
            ->whereBetween('created_at', array($desde,$hasta)) 
            ->firstOrFail();

            $ahora18 = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Ahora18')
            //->whereDate('created_at', '>=',$desde)  
            ->whereBetween('created_at', array($desde,$hasta)) 
            ->firstOrFail();

            return view('estadisticas.caja', compact('cajas','movimientos','efectivo','cheque','transferencia','mercado','tarjeta','ahora6','ahora12','ahora18','desde','hasta'));
        
    }

    public function indexVentas()
    {
        $vendedores = User::where('tipo','like','vendedor')->get();

        return view('estadisticas.indexVentas',compact('vendedores'));
        
    }

    public function ventasDiaria (Request $request){

        $dia = \Carbon\Carbon::parse($request->dia)->format('d/m/Y');

        $vendedor = User::find($request->vendedor_id);

        $ventas = Pedido::where('usuario_id','=',$request->vendedor_id)->whereDate('fecha',$request->dia)->orderBy('id','desc')->get();

        $total = Pedido::select(DB::raw('sum(total) as totalPesos'),DB::raw('sum(totalDolares) as totalDolares'))
                            ->where('usuario_id','=',$request->vendedor_id)                     
                            ->whereDate('fecha',$request->dia)
                            ->firstOrFail();

        return view('estadisticas.ventasPorDia',compact('ventas','dia','total','vendedor'));
    }

    public function ventasMensual (Request $request){

        $vendedor = User::find($request->vendedor_id);

        $ventas = Pedido::select( DB::raw("MONTH(fecha) as mes"),DB::raw("MONTHNAME(fecha) as nombre"),DB::raw("YEAR(fecha) as anio"),DB::raw('sum(total) as totalPesos'),DB::raw('sum(totalDolares) as totalDolares'),DB::raw('sum(total) as totalPesos'),DB::raw('sum(totalDolares) as totalDolares'))
                                       ->groupBy( DB::raw("MONTH(fecha)"),DB::raw("YEAR(fecha)"),DB::raw("MONTHNAME(fecha)"))
                                       ->where('usuario_id','=',$request->vendedor_id)   
                                       ->whereYear('fecha', '=', $request->anio)
                                       ->orderBy( DB::raw("MONTH(fecha)"),'asc')
                                       ->get();
        
        $total = Pedido::select(DB::raw('sum(total) as totalPesos'),DB::raw('sum(totalDolares) as totalDolares'))
                                       ->groupBy( DB::raw("MONTH(fecha)"),DB::raw("YEAR(fecha)"))
                                       ->where('usuario_id','=',$request->vendedor_id)   
                                       ->whereYear('fecha', '=', $request->anio)
                                       ->orderBy( DB::raw("MONTH(fecha)"),'asc')
                                       ->get();


        return view('estadisticas.ventasPorMes',compact('ventas','total','vendedor'));
    }
    
}
