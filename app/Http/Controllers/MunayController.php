<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Cajas;
use App\MovimientoCaja;
use App\Pedido;
use App\Detalle_Pedido;
use App\Cliente;
use App\Provincia;
use App\Dolar;
use App\Producto;
use App\Producto_Material;
use App\Material;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;

class MunayController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    public function cajasIndex()
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');

        $dia = $mytime->toDateTimeString();

        $caja = Cajas::find(Auth::user()->caja_id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $fechaApertura = MovimientoCaja::where('cajas_id','like',Auth::user()->caja_id)
        ->where('descripcion','like' ,'Apertura de Caja')
        ->orderBy('id','DESC')
        ->firstOrFail();

        $movimientos = MovimientoCaja::where('cajas_id','like',Auth::user()->caja_id)
        ->whereBetween('created_at', array($fechaApertura->created_at,$dia))
        ->orderBy('id','DESC')
        ->get();

        $total = MovimientoCaja::count();

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        if($total == 0){

            $mytime = Carbon::now('America/Argentina/Tucuman');

            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = Auth::user()->caja_id;

            $movimiento->descripcion = 'Creacion de Caja';

            $movimiento->fecha = $mytime->toDateTimeString();

            $movimiento->entrada = '0';

            $movimiento->salida = '0';

            $movimiento->moneda =  'Pesos';

            $movimiento->tipo =  'Efectivo';

            $movimiento->saldoparcialpesos =  '0';

            $movimiento->saldoparcialdolares =  '0';

            $movimiento->cotizacion =  $dolar->valor;

            $movimiento->save();
 
        }

        return view('munay.cajas.home', compact('caja','dolar','movimientos'));
    }

    public function abrirCerrarCaja(Request $request,$id)
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');
                
        $cajas = cajas::find(Auth::user()->caja->id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        if($cajas->estado == 'abierta'):

            $cajas->estado = "cerrada";

            $cajas->saldoPesos = 0;

            $cajas->save();

            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = Auth::user()->caja->id;

            $movimiento->descripcion = 'Cierre de Caja';

            $movimiento->fecha = $mytime->toDateTimeString();

            $movimiento->entrada = '0';

            $movimiento->salida = '0';

            $movimiento->moneda = 'Pesos';

            $movimiento->tipo = 'Efectivo';

            $movimiento->saldoparcialpesos =  $cajas->saldoPesos + 0;

            $movimiento->saldoparcialdolares = 0;

            $movimiento->cotizacion =  $dolar->valor;

            $movimiento->save();


        else:
            
            $cajas->estado = "abierta";

            $cajas->saldoPesos = 0;

            $cajas->save();

            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = Auth::user()->caja->id;

            $movimiento->descripcion = 'Apertura de Caja';

            $movimiento->fecha = $mytime->toDateTimeString();

            $movimiento->entrada = '0';

            $movimiento->salida = '0';

            $movimiento->moneda = 'Pesos';

            $movimiento->tipo = 'Efectivo';

            $movimiento->saldoparcialpesos =  0;

            $movimiento->saldoparcialdolares =  0;

            $movimiento->cotizacion =  $dolar->valor;

            $movimiento->save();

        endif;

        return redirect()->route('munayCajas.index');

    }

    public function sumarCaja(Request $request,$id)
    {
        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $mytime = Carbon::now('America/Argentina/Tucuman');

        $rules = [

            'descripcion' => 'required',

            'monto' => 'required'
        ];

        $message = [
            
            'descripcion.requiered' => 'Ingrese La descripcion Del Movimiento',

            'monto.requiered' => 'Ingrese el Monto Del Movimiento',

        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if( $validator->fails()):
            
            return back()->withErrors($validator)->with('message','Se ha Producido un Error')->with('typealert','danger');

        else:
                        
            $cajas = cajas::find($id);

            $cajas->saldoPesos = $cajas->saldoPesos + $request->monto;

            $cajas->save();

            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = $cajas->id;

            $movimiento->descripcion = $request->descripcion;

            $movimiento->fecha = $mytime->toDateTimeString();

            $movimiento->entrada = $request->monto;

            $movimiento->salida = '0';

            $movimiento->moneda =  'Pesos';

            $movimiento->tipo = $request->modoPago;;

            $movimiento->saldoparcialpesos =  $cajas->saldoPesos;

            $movimiento->saldoparcialdolares = 0;

            $movimiento->cotizacion =  $dolar->valor;

            $movimiento->save();

            return back()->with('message','Ingreso De Dinero Exitoso')->with('typealert','success');
                 
        endif;
    }

    public function restaCaja(Request $request)
    {
        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $mytime = Carbon::now('America/Argentina/Tucuman');

        $rules = [

            'descripcion' => 'required',

            'monto' => 'required'
        ];

        $message = [
            
            'descripcion.requiered' => 'Ingrese La descripcion Del Movimiento',

            'monto.requiered' => 'Ingrese el Monto Del Movimiento',

        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if( $validator->fails()):
            
            return back()->withErrors($validator)->with('message','Se ha Producido un Error')->with('typealert','danger');

        else:
                        
            $cajas = cajas::find(Auth::user()->caja->id);

            $cajas->saldoPesos = $cajas->saldoPesos - $request->monto;

            $cajas->save();

            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = Auth::user()->caja->id;

            $movimiento->descripcion = $request->descripcion;

            $movimiento->fecha = $mytime->toDateTimeString();

            $movimiento->entrada = '0';

            $movimiento->salida = $request->monto;

            $movimiento->moneda =  'Pesos';

            $movimiento->tipo = $request->modoPago;

            $movimiento->saldoparcialpesos =  $cajas->saldoPesos;

            $movimiento->saldoparcialdolares = 0;

            $movimiento->cotizacion =  $dolar->valor;

            $movimiento->save();

            
            return back()->with('message','Se Ha Retirado Dinero de Caja')->with('typealert','success');
                 
        endif;
    }

    public function cajaDiaria (Request $request,$id)
    {
        $cajas = Cajas::find(Auth::user()->caja->id);

        $mytime = Carbon::now('America/Argentina/Tucuman');

        $dia = $mytime->toDateTimeString();

        if($cajas->estado == 'abierta'){
            
            $fechaApertura = MovimientoCaja::where('cajas_id','like',Auth::user()->caja->id)
            ->where('descripcion','like' ,'Apertura de Caja')
            ->orderBy('id','DESC')
            ->firstOrFail();
   
            $movimientos = MovimientoCaja::where('cajas_id','like',Auth::user()->caja->id)
            //->whereDate('created_at', '>=',$fechaApertura->created_at)
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia))
            ->where('descripcion','not like' ,'Cierre de Caja')
            ->orderBy('id','DESC')
            ->get();

            $efectivo = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja->id)
            ->where('tipo','like','Efectivo')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)   
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia))
            ->firstOrFail();

            $cheque = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja->id)
            ->where('tipo','like' ,'Cheque')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $transferencia = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja->id)
            ->where('tipo','like' ,'Transferencia Bancaria')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $mercado = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja->id)
            ->where('tipo','like' ,'Mercado Pago')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

        }
        else{
            return view('cajas.detalleDiarioError', compact('cajas'));
        }

        return view('munay.cajas.detalleDiarioCaja', compact('cajas','movimientos','efectivo','cheque','transferencia','mercado'));

    }

    public function reporteCajaDiario(){

        $cajas = Cajas::find(Auth::user()->caja->id);

        $mytime = Carbon::now('America/Argentina/Tucuman');

        $dia = $mytime->toDateTimeString();
            
        $fechaApertura = MovimientoCaja::where('cajas_id','like',Auth::user()->caja->id)
            ->where('descripcion','like' ,'Apertura de Caja')
            ->orderBy('id','DESC')
            ->firstOrFail();

            $movimientos = MovimientoCaja::where('cajas_id','like',Auth::user()->caja->id)
            //->whereDate('created_at', '>=',$fechaApertura->created_at)
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia))
            ->where('descripcion','not like' ,'Cierre de Caja')
            ->orderBy('id','DESC')
            ->get();

            $efectivo = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja->id)
            ->where('tipo','like','Efectivo')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)   
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia))
            ->firstOrFail();

            $cheque = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja->id)
            ->where('tipo','like' ,'Cheque')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $transferencia = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja->id)
            ->where('tipo','like' ,'Transferencia Bancaria')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $mercado = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',Auth::user()->caja->id)
            ->where('tipo','like' ,'Mercado Pago')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

        $pdf = PDF::loadView('munay.cajas.reporteCajaDiaria',compact('fechaApertura','cajas','movimientos','efectivo','cheque','transferencia','mercado'))->setPaper('a4','portrait');
    
        return $pdf->stream();
    }

    public function pedidos(Request $request){

        $searchText = $request->searchText;

        $searchCondicion = $request->searchCondicion;

        if($searchCondicion && $searchText){
        
            if($searchCondicion == 'razon_Social'){
                
                $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                ->select('pedidos.num_pedido','pedidos.fecha','pedidos.cliente_id','pedidos.usuario_id','pedidos.estado','pedidos.pago','pedidos.id as id','pedidos.total','pedidos.deposito_id')
                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                ->where('pedidos.unidad_id','=',4)
                ->orderBy('pedidos.id','desc')
                ->paginate(500);

            }
            else{
            
                $pedidos = Pedido::where($searchCondicion,'like','%'.$searchText.'%')->where('unidad_id','=',4)->orderBy('id', 'DESC')->paginate(200);       
            
            }
        
        }
        else{
            
                $pedidos = Pedido::with(['user','deposito','cliente'])->where('unidad_id','=',4)
                ->where('estado','not like','Cancelado')
                ->Where('pago','not like', 'Pagado')
                ->orderBy('id', 'desc')
                ->paginate(20);
        }
  
        return view('munay.ventas.index', compact('pedidos'));

    }

    public function seleccionarCliente(Request $request){

        $searchText = $request->searchText;

        if($searchText){
            
            $clientes = Cliente::where('razon_Social','like','%'.$searchText.'%')->orderBy('id', 'DESC')->paginate(200);

        }
        else{
            $clientes = Cliente::orderBy('id', 'DESC')->paginate(25);
        }
        
        $provincias = Provincia::orderBy('nombre', 'ASC')
        ->select('nombre as nombre', 'id as id')
        ->get();
        return view('munay.ventas.seleccionarCliente',["clientes"=>$clientes,"provincias"=>$provincias]);

    }

    public function createPedido($cliente_id){

        $cliente = Cliente::find($cliente_id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $productos = Producto::join('deposito_producto','productos.id','=','deposito_producto.producto_id')
            ->join('depositos','depositos.id','=','deposito_producto.deposito_id')
            ->select('productos.id','productos.codigo','productos.moneda','productos.nombre','deposito_producto.stock','depositos.nombre as depositos',
            'productos.precioLocalB as local1','depositos.id as iddeposito')
            ->where('productos.unidadnegocio_id','=',4)
            ->orderBy('productos.id','desc')
            ->get();

        return view('munay.ventas.create',["cliente"=>$cliente,"productos"=>$productos,'dolar'=>$dolar]);

    }

    public function storePedido (Request $request)
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');

        $precioDolares = 0;

        $totalDolares = 0;

        $totalPesos = 0;

        //$cajas = cajas::find(Auth::user()->caja_id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();
        
        $cliente = Cliente::find($request->cliente_id);

        try{
            
            DB::beginTransaction();
            
            $mytime = Carbon::now('America/Argentina/Tucuman');
            
            $pedido = new Pedido;
            $pedido->cliente_id = $request->cliente_id;
            $pedido->usuario_id = Auth::user()->id;
            $pedido->num_pedido= '0';
            $pedido->fecha = $mytime->toDateTimeString();
            $pedido->tipo_entrega = $request->elegido;
            $pedido->modo_venta = $request->modoPago;
            $pedido->cotizacion =  $dolar->valor;
            if($request->modoPago == 'Ahora6' || $request->modoPago == 'Ahora12' || $request->modoPago == 'Ahora18')
            {

                if($request->modoPago == 'Ahora6'){
                    $total = $request->total_venta_pesos;
                    $pedido->total = $total + ($total * 0.08);
                }
                if($request->modoPago == 'Ahora12'){
                  $total = $request->total_venta_pesos;
                  $pedido->total = $total + ($total * 0.15);
                }
                if($request->modoPago == 'Ahora18'){
                        $total = $request->total_venta_pesos;
                        $pedido->total = $total + ($total * 0.20);
                }
                
            }
            else{
                $pedido->total = $request->total_venta_pesos;
            }
            $pedido->deposito_id = Auth::user()->caja->deposito_id;
            $pedido->unidad_id = '4';
            $pedido->observaciones = $request->observaciones;
            $pedido->tipo = "Pesos";        
            $pedido->estado = "Preparando";
            $pedido->pago = "Impago";  
            $pedido->save();

            if (count( json_decode($request->productosEnPedidos,true) ) > 0) {

                $proEnPedido = json_decode($request->productosEnPedidos,true);
                
                for ($i=0; $i < count($proEnPedido); $i++) { 

                    $producto = Producto::find($proEnPedido[$i]['idProducto']);

                    if($producto->moneda == 'Dolares'){
            
                        if($cliente->facturacion == 'Si'){
            
                            $precioDolares = $producto->precioLocal;
            
                        }
            
                        else{
                            $precioDolares = $producto->precioLocalB;
                        }
            
                        $totalDolares = $totalDolares + ($precioDolares * $proEnPedido[$i]['cantidad']);
                 
                    }
            
                    else{
            
                        $totalPesos = $totalPesos +  ($proEnPedido[$i]['precio'] * $proEnPedido[$i]['cantidad'] ) ;
                    }
            
                    $detalle = new Detalle_Pedido();
                    
                    $detalle->pedido_id = $pedido->id;
                    
                    $detalle->producto_id = $proEnPedido[$i]['idProducto'];
                    
                    $detalle->deposito_id = $pedido->deposito_id;
                    
                    $detalle->cantidad = $proEnPedido[$i]['cantidad'];
                    
                    $detalle->precio = $proEnPedido[$i]['precio'];

                    $detalle->descuento = $proEnPedido[$i]['descuento'];
            
                    $detalle->precioDolares = $precioDolares;
            
                    $detalle->cotizacion =  $dolar->valor;
                    
                    $detalle->estado = 'Preparado';
                    
                    $detalle->save();                                 
                    
                }
            }

            $pedido2 = Pedido::find($pedido->id);
            $pedido2->num_pedido = 'NVT-4'.Auth::user()->caja_id.'-'.date('Y').'-'.$pedido->id;
            $pedido2->totalDolares = $totalDolares;
            $pedido2->save();
         
            DB::commit();
        }

        catch(Exception $e){  
            DB::rollback();
        }

        return redirect()->route('munay.pedidos')->with('success','Pedido agregado correctamente');    
    }


    public function productos(Request $request){

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $searchText = $request->searchText;

        if($searchText){

            $articulos = Producto::where('nombre','LIKE','%'.$searchText.'%')->where('unidadnegocio_id','=','4')->orderBy('nombre', 'ASC')->paginate(50);
        
        }
        else{
        
            $articulos = Producto::where('unidadnegocio_id','=','4')->orderBy('nombre', 'ASC')->paginate(25);
        
        }
        
        return view('munay.productos.index', compact('articulos','dolar'));

    }

    public function productosedit($id)
    {
        $producto = Producto::find($id);
        
        return view('munay.productos.edit', compact('producto'));
    }

    public function productosupdate(Request $request,$id)
    {
        $producto = Producto::find($id);
        
        $producto->codigo = '0';
        
        $producto->nombre = $request->nombre;
        
        $producto->descripcion = $request->descripcion;

        $producto->precioLocal = $request->precioFinal;

        $producto->precioLocalB = $request->precioFinal;
        
        $producto->beneficio = $request->beneficio;

        if($request->hasFile('imagen'))
        {
            $file = $request->file('imagen');
            $uniqueFileName = $producto->nombre . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/productos');
            $request->img->move($destino,$uniqueFileName);         
            $producto->imagen = $uniqueFileName;
        }

        $producto->save();

        return redirect()->route('munay.productos');

    }

    public function showProductos($id){
        
        $materiaPrimas = Producto_Material::where('producto_id','=',$id)->get();
       
        if(count($materiaPrimas) == 0){
            $producto = Producto::find($id);
        }
        else{
            $producto = Producto::join('productos_material','productos.id','productos_material.producto_id')
            ->join('materias_primas','productos_material.material_id','materias_primas.id')
            ->select('productos.imagen',
                    'productos.nombre',
                    'productos.descripcion',
                    'productos.unidadnegocio_id',
                    'productos.beneficio',
                    'productos.precioLocal',
                    'productos.id',
                    DB::raw('sum(productos_material.cantidad * materias_primas.costo) as cantidad'))
            ->where('productos.id','=',$id)
            ->groupBy('productos.imagen',
                    'productos.nombre',
                    'productos.descripcion',
                    'productos.unidadnegocio_id',
                    'productos.beneficio',
                    'productos.precioLocal',
                    'productos.id')
            ->firstOrFail();
        }

        $materias = Material::orderBy('descripcion','desc')->get();

        return view('munay.productos.show', compact('producto','materiaPrimas','materias'));
    }


    public function materiasindex(Request $request)
    {
        
        $searchText = $request->searchText;
 
        if($searchText){
        
            $materiales = Material::where('descripcion','like','%'.$searchText.'%')->paginate(100);
        }
        else{
            $materiales = Material::orderBy('descripcion', 'DESC')->paginate(20);
        }
  
        return view('munay.materiaPrima.index', compact('materiales'));
    }
    
    public function materiasstore(Request $request)
    {
        $material = new Material();
                        
        $material->descripcion = $request->descripcion;

        $material->detalle = $request->detalle;

        $material->costo = $request->costo;

        $material->moneda = $request->moneda;

        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $uniqueFileName = $material->descripcion . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/productos');
            $request->img->move($destino,$uniqueFileName);         
            $material->imagen = $uniqueFileName;
        }

        $material->save();

        return redirect()->route('munay.materiales.index')->with('success','producto agregado correctamente');
    }

    public function materiasupdate(Request $request)
    {
        $material = Material::find($request->material_id);
                        
        $material->descripcion = $request->descripcion;

        $material->detalle = $request->detalle;

        $material->costo = $request->costo;

        $material->moneda = $request->moneda;

        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $uniqueFileName = $material->descripcion . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/productos');
            $request->img->move($destino,$uniqueFileName);         
            $material->imagen = $uniqueFileName;
        }

        $material->save();

        return redirect()->route('munay.materiales.index')->with('success','producto agregado correctamente');
    }



    public function clientes(Request $request)
    {
        $searchText = $request->searchText;

        $searchCondicion = $request->searchCondicion;

        if($searchCondicion && $searchText){

            $clientes = Cliente::where($searchCondicion,'like','%'.$searchText.'%')->orderBy('id', 'DESC')->paginate(200);
           
        }
        else{
            $clientes = Cliente::orderBy('id', 'DESC')->paginate(20);
        }
        
        $date = ['clientes' => $clientes];

        return view('munay.clientes.home',$date);
    }

    public function clientescreate($condicion)
    {

        $provincias = Provincia::orderBy('nombre', 'ASC')->pluck('nombre','id');

        $date = ['provincias' => $provincias,'condicion' => $condicion];

        return view('munay.clientes.create',$date);
    }

    public function clientesstore(Request $request)
    {

        $rulesValidation = [
            'nombre' => 'required',
            'direccion' => 'required',
        ];

        $messages = [
            'nombre.required' => 'El Nombre del Cliente Obligatorio',
            'direccion.required' => 'Se Necesita una Direccion',
        ];

        $validator = Validator::make($request->all(),$rulesValidation,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error','typealert','danger')->withInput();
        else:
    
            $cliente = new Cliente;
            $cliente->nombre_Fantasia = e($request->input('nombre'));
            $cliente->razon_Social = e($request->input('nombre'));
            $cliente->telefonos = e($request->input('telefonos'));
            $cliente->email = e($request->input('email'));;
            $cliente->direccion = e($request->input('direccion'));;
            $cliente->ciudad = e($request->input('ciudad'));
            $cliente->codigo_postal = e($request->input('codigo_postal'));
            $cliente->genero = $request->genero;
            $cliente->tipo = $request->tipo;
            $cliente->provincia_id = $request->provincia_id;
            $cliente->rubro_id = 1;
            
            if(Auth::user()->tipo == "admin"):
                $cliente->facturacion = $request->facturacion;
                $cliente->cuentaCorriente = $request->cuentaCorriente;
                $cliente->montoCuenta = e($request->input('montoCuenta'));
                $cliente->montoCuentaPesos = e($request->input('montoCuentaPesos'));
            else:
                $cliente->facturacion = 'No';
                $cliente->cuentaCorriente = 'No';
                $cliente->montoCuenta = '0';
                $cliente->montoCuentaPesos = '0';
            endif;
            $cliente->save();

            $cliente2 = Cliente::find($cliente->id);
            $cliente2->num_cliente = 'NCT-'.$cliente->id ;

            if($cliente2->save()):
                $condicion = $request->condicion;
                if($condicion == 0):
                    return redirect()->route('munay.clientes')->with('message','Cliente Registrado con exito','typealert','success');;
                else:
                    return redirect('/Munay/Pedidos/create/'.$cliente->id);
                endif;

            endif;

        endif;

    }

    public function clientesshow($id)
    {
        $cliente = Cliente::findOrFail($id);

        $productosComprados = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
        ->join('pedidos','detalle_pedido.pedido_id','=','pedidos.id')
        ->select('productos.imagen','productos.nombre',DB::raw('count(detalle_pedido.id) as cantidad'))
        ->where('pedidos.cliente_id','=',$id)
        ->groupBy('productos.nombre','productos.imagen')
        ->orderBy('total','desc')                   
        ->get();

        $date = ['cliente' => $cliente,'productosComprados' => $productosComprados];

        return view('munay.clientes.show', $date);
    }

    public function clientesedit($id)
    {
        $cliente = Cliente::findOrFail($id);
                
        $provincias = Provincia::orderBy('nombre', 'ASC')->pluck('nombre','id');

        $date = ['cliente' => $cliente ,'provincias' => $provincias];

        return view('munay.clientes.edit', $date);
    }

    public function clientesupdate(Request $request, $id)
    {
        $rulesValidation = [
            'nombre' => 'required',
            'direccion' => 'required',
        ];

        $messages = [
            'nombre.required' => 'El Nombre del Cliente Obligatorio',
            'direccion.required' => 'Se Necesita una Direccion',
        ];

        $validator = Validator::make($request->all(),$rulesValidation,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error','typealert','danger')->withInput();
        else:
    
            $cliente = Cliente::findOrFail($id);
            $cliente->nombre_Fantasia = e($request->input('nombre'));
            $cliente->razon_Social = e($request->input('nombre'));
            $cliente->telefonos = e($request->input('telefonos'));
            $cliente->email = e($request->input('email'));;
            $cliente->direccion = e($request->input('direccion'));;
            $cliente->ciudad = e($request->input('ciudad'));
            $cliente->codigo_postal = e($request->input('codigo_postal'));
            $cliente->genero = $request->genero;
            $cliente->tipo = $request->tipo;
            $cliente->provincia_id = $request->provincia_id;
            $cliente->rubro_id = 1;
            
            if(Auth::user()->tipo == "admin"):
                $cliente->facturacion = $request->facturacion;
                $cliente->cuentaCorriente = $request->cuentaCorriente;
                $cliente->montoCuenta = e($request->input('montoCuenta'));
                $cliente->montoCuentaPesos = e($request->input('montoCuentaPesos'));
            else:
                $cliente->facturacion = 'No';
                $cliente->cuentaCorriente = 'No';
                $cliente->montoCuenta = '0';
                $cliente->montoCuentaPesos = '0';
            endif;
            $cliente->save();

            $cliente2 = Cliente::find($cliente->id);
            $cliente2->num_cliente = 'NCT-'.$cliente->id ;

            if($cliente2->save()):
                return back()->with('message','Cliente Actualizado con exito','typealert','success');;
            endif;

        endif;
    }

}
