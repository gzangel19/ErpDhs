<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposito;
use App\DepositoProducto;
use App\Provincia;
use App\Producto;
use App\Cajas;
use App\Pedido;
use App\Movimiento;
use App\MovimientoDeposito;
use App\HistorialMovimientos;
use DB;
use Carbon\Carbon;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DepositoProductoExport;
use App\Imports\DepositoProductsImport;
use Validator;


class DepositoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index(Request $request){
        
        $depositos = Deposito::with(['provincia'])->orderBy('id', 'DESC')->paginate(10);
        
        return view('deposito.index', compact('depositos'));

    }

    public function show(Request $request,$id)
    {

        $deposito = Deposito::find($id);
        
        $productos = DB::table('productos as pro')
        ->join('deposito_producto as dp','pro.id','=','dp.producto_id')
        ->join('depositos as dep','dp.deposito_id','=','dep.id')
        ->select('pro.id as producto_id','pro.imagen as imagen','pro.nombre as nombre','dp.stock','dep.nombre as deposito','dp.stock_reservado','dp.stock_enflete','dp.stock_critico','dp.ubicacion','dp.id as depositoId')
        ->where('dep.id','=',$id)
        ->orderBy('pro.nombre', 'ASC')
        ->get();

        $date = ['deposito' => $deposito,'productos' => $productos];

        return view('deposito.show', $date);

    }


    public function create()
    {
        $provincias = Provincia::orderBy('nombre', 'ASC')->pluck('nombre','id');

        $date = ['provincias' => $provincias];

        return view('deposito.create',$date);
    }

    public function store(Request $request)
    {
        $rulesValidation = [
            'nombre' => 'required',
            'telefonos' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required'
        ];

        $messages = [
            'nombre.required' => 'El Nombre de la Sucursal Obligatorio',
            'telefonos.required' => 'Se Necesita un Telefono',
            'direccion.required' => 'Se Necesita una Direccion',
            'ciudad.required' => 'Falta Ciudad de la Sucursal'
        ];

        $validator = Validator::make($request->all(),$rulesValidation,$messages);

        if($validator->fails()):
        
            return back()->withErrors($validator)->with('message','Se ha producido un error','typealert','danger')->withInput();
        
        else:

            $deposito = new Deposito;
            $deposito->nombre = e($request->input('nombre'));
            $deposito->telefonos = e($request->input('telefonos'));
            $deposito->direccion = e($request->input('direccion'));
            $deposito->ciudad = e($request->input('ciudad'));
            $deposito->codigo_postal = e($request->input('codigo_postal'));
            $deposito->provincia_id = $request->provincia_id;
            
            if($deposito->save()):
            
                $cajas =  new Cajas;
                $cajas->deposito_id = $deposito->id;
                $cajas->nombre = 'Caja ' . $deposito->nombre;
                $cajas->estado = 'Cerrada';
                $cajas->saldoPesos = 0;
                $cajas->saldoDolares = 0;
                $cajas->cotizacion = 0;

                if($cajas->save()):
                    
                    $depositos = Deposito::find($deposito->id);
                    $depositos->caja_id = $cajas->id;
                    $depositos->save();

                    return redirect()->route('getDepositos')->with('message','Deposito Creado con exito','typealert','success');;
                
                endif;
            
            endif;

        endif;

    }

  

    public function edit($id)
    {
        $deposito = Deposito::findOrFail($id);

        $provincias = Provincia::orderBy('nombre', 'ASC')->pluck('nombre','id');

        $date = ['provincias' => $provincias,'deposito' => $deposito];

        return view('deposito.edit', $date);

    }

    public function update(Request $request, $id)
    {

        $rulesValidation = [
            'nombre' => 'required',
            'telefonos' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required'
        ];

        $messages = [
            'nombre.required' => 'El Nombre de la Sucursal Obligatorio',
            'telefonos.required' => 'Se Necesita un Telefono',
            'direccion.required' => 'Se Necesita una Direccion',
            'ciudad.required' => 'Falta Ciudad de la Sucursal'
        ];

        $validator = Validator::make($request->all(),$rulesValidation,$messages);

        if($validator->fails()):
        
            return back()->withErrors($validator)->with('message','Se ha producido un error','typealert','danger')->withInput();
        
        else:

            $deposito = Deposito::findOrFail($id);
            $deposito->nombre = $request->nombre;
            $deposito->telefonos = $request->telefonos;
            $deposito->direccion = $request->direccion;
            $deposito->ciudad = $request->ciudad;
            $deposito->codigo_postal = $request->codigo_postal;
            $deposito->provincia_id = $request->provincia_id;

        
            if($deposito->save()):

                return redirect()->route('getDepositos')->with('message','Deposito Creado con exito','typealert','success');
            
            endif;

             
        endif;

    
    }

    public function updateStock(Request $request)
    {

        $depositoProducto = DepositoProducto::find($request->idUpdate);
        $depositoProducto->stock = $request->stockUpdate;
        $depositoProducto->save();

        return back();
    }

    public function moverProducto($depositoOrigen_id){

        $productos = Producto::join('deposito_producto','productos.id','=','deposito_producto.producto_id')
        ->join('depositos','depositos.id','=','deposito_producto.deposito_id')
        ->select('productos.id','productos.codigo','productos.moneda','productos.nombre','deposito_producto.stock','depositos.nombre as depositos',
        'productos.precioLocal as local1','depositos.id as iddeposito')
        ->where('depositos.id','like',$depositoOrigen_id)
        ->orderBy('productos.id','desc')
        ->get();

        $depositos = Deposito::where('id','not like',$depositoOrigen_id)->orderBy('id', 'DESC')->paginate(10);

        $deposito = Deposito::find($depositoOrigen_id);

        return view('deposito.movimientos',compact('depositos','productos','deposito'));
    }

    public function movimientoStore(Request $request)
    {
  
        //CREO EL MOVIMIENTO DEL STOCK DEPENDIENDO DEL ESTADO//

        $mytime = Carbon::now('America/Argentina/Tucuman');
        
        $movimientos = new Movimiento();
        $movimientos->fecha = $mytime->toDateTimeString();
        $movimientos->depositoOrigen_id = $request->depositoOrigen_id;
        $movimientos->depositoDestino_id = $request->depositoDestino_id;
        $movimientos->save();

        if (count( json_decode($request->productosEnPedidos,true) ) > 0) {

            $proEnPedido = json_decode($request->productosEnPedidos,true);
             
            for ($i=0; $i < count($proEnPedido); $i++) { 

                $movimientosDeposito = new MovimientoDeposito();
                $movimientosDeposito->idMovimiento = $movimientos->id;
                $movimientosDeposito->idProducto = $proEnPedido[$i]['idProducto'];;
                $movimientosDeposito->cantidad = $proEnPedido[$i]['cantidad'];
                $movimientosDeposito->save();

                $depositoOrigen = DepositoProducto::where('producto_id','like',$movimientosDeposito->idProducto)
                ->where('deposito_id','like',$movimientos->depositoOrigen_id )
                ->firstOrFail();
                $depositoOrigen->stock = $depositoOrigen->stock - $movimientosDeposito->cantidad;
                $depositoOrigen->save();
              

                $depositoPedido = DepositoProducto::where('producto_id','like',$movimientosDeposito->idProducto)
                ->where('deposito_id','like',$movimientos->depositoDestino_id )
                ->get();

                

                if($depositoPedido->isEmpty()){
                    $depPedi = new DepositoProducto();
                    $depPedi->stock = $movimientosDeposito->cantidad;
                    $depPedi->stock_reservado =  0;
                    $depPedi->stock_critico = 0;
                    $depPedi->ubicacion = 'Estanterias';
                    $depPedi->deposito_id = $movimientos->depositoDestino_id;
                    $depPedi->producto_id = $movimientosDeposito->idProducto;
                    $depPedi->save();
                } 
                else{
                    $depositoDestino = DepositoProducto::where('producto_id','like',$movimientosDeposito->idProducto)
                                                        ->where('deposito_id','like',$movimientos->depositoDestino_id)
                                                        ->firstOrFail();
                    $depositoDestino->stock= $depositoDestino->stock + $movimientosDeposito->cantidad;
                    $depositoDestino->save();
                }

            }

            
        }

        return redirect()->route('getDepositos');
        
    }

    
}
