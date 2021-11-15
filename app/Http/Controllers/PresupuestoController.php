<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Producto;
use App\Cliente;
use App\Presupuesto;
use App\Provincia;
use App\Detalle_Presupuesto;
use App\Pedido;
use App\Detalle_Pedido;
use App\Deposito;
use App\DepositoProducto;
use App\Cajas;
use DB;
use App\Unidad_Negocio;
use Carbon\Carbon;
use App\User;
use Response;
use Illuminate\Support\Collection;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PresupuestoExport;

class PresupuestoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index(Request $request){
        
        $presupuestos = Presupuesto::orderBy('id', 'DESC')->paginate(20);

        $total = Presupuesto::count();
        
        return view('presupuesto.index', compact('presupuestos','total'));

    }

    public function seleccionar(){

        $clientes = Cliente::orderBy('id', 'ASC')->paginate(10);

        $provincias = Provincia::orderBy('nombre', 'ASC')
        ->select('nombre as nombre', 'id as id')
        ->get();

        return view('presupuesto.seleccionarCliente',["clientes"=>$clientes,"provincias"=>$provincias]);

    }

    public function storeCliente (Request $request)
    {
        $cliente = new Cliente;
        $cliente->nombre_Fantasia = $request->nombre;
        $cliente->razon_Social = $request->nombre;
        $cliente->cuit_cuil = $request->cuit_cuil;
        $cliente->telefonos = $request->telefonos;
        $cliente->email = '';
        $cliente->direccion = $request->direccion;
        $cliente->ciudad = $request->ciudad;
        $cliente->codigo_postal = '4111';
        $cliente->genero = $request->genero;
        $cliente->tipo = $request->tipo;
        $cliente->provincia_id = $request->provincia_id;
        $cliente->rubro_id = 1;
        $cliente->facturacion = $request->facturacion;

        if($request->cuentaCorriente == 'No'){
            $cliente->cuentaCorriente = 'No';
            $cliente->montoCuenta = '0';
            $cliente->montoCuentaPesos = '0';
        }
        else{
            $cliente->cuentaCorriente = $request->cuentaCorriente;
            $cliente->montoCuenta = $request->montoCuenta;
            $cliente->montoCuentaPesos = $request->montoCuentaPesos;
        }
        $cliente->save();

        return redirect()->route('presupuesto.seleccionarNegocio',$cliente->id);
    }

    public function seleccionarNegocio($cliente){

        $cliente_id = $cliente;

        $user = User::find(Auth::user()->id);

        $unidadesnegocio_usuario = $user->unidades_negocios()->get();

        return view('presupuesto.seleccionarNegocio',["cliente"=>$cliente_id,"unidades"=>$unidadesnegocio_usuario]);

    }

    public function create($cliente_id,$unidad_id){

        $cliente = Cliente::find($cliente_id);

        $cajas = Cajas::find(1);

        if($cliente->facturacion == 'Si'){
            $productos = Producto::join('deposito_producto','productos.id','=','deposito_producto.producto_id')
            ->join('depositos','depositos.id','=','deposito_producto.deposito_id')
            ->select('productos.id','productos.codigo','productos.moneda','productos.nombre','deposito_producto.stock','depositos.nombre as depositos',
            'productos.precioLocal as local1','depositos.id as iddeposito')
            ->orderBy('productos.id','desc')
            ->get();
        }
        else{
            $productos = Producto::join('deposito_producto','productos.id','=','deposito_producto.producto_id')
            ->join('depositos','depositos.id','=','deposito_producto.deposito_id')
            ->select('productos.id','productos.codigo','productos.moneda','productos.nombre','deposito_producto.stock','depositos.nombre as depositos',
            'productos.precioLocalB as local1','depositos.id as iddeposito')
            ->orderBy('productos.id','desc')
            ->get();
        }

        $unidad = Unidad_Negocio::find($unidad_id);

        $depositos = Deposito::orderBy('id', 'ASC')->where('id','<>','1')->get();
        
        return view('presupuesto.create',compact('cliente','productos','cajas','unidad','depositos'));

    }

    public function store(Request $request)
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');

        $precioDolares = 0;

        $totalDolares = 0;

        $totalPesos = 0;

        $cajas = cajas::find(1);

        $cliente = Cliente::find($request->cliente_id);

        try{
            DB::beginTransaction();
                 
            $presupuesto = new Presupuesto;
            
            $presupuesto->usuario_id = Auth::user()->id;

            $presupuesto->num_comprobante = "";

            $presupuesto->tipo = 'Presupuesto';
            
            $presupuesto->fecha = $mytime->toDateTimeString();

            $presupuesto->total = $request->total_venta_pesos;

            $presupuesto->cliente_id = $request->cliente_id;

            $presupuesto->tipo_entrega = $request->elegido;

            $presupuesto->cotizacion =  $cajas->cotizacion;

            $presupuesto->totalDolares = 0;

            $presupuesto->modo_venta = $request->modoPago;

            $presupuesto->mantenimiento = $request->mantenimiento;

            $presupuesto->nota = $request->nota;

            $presupuesto->estado = 'Pendiente';
            
            $presupuesto->save();

            if (count( json_decode($request->productosEnPedidos,true) ) > 0) {

               $proEnPresupuesto = json_decode($request->productosEnPedidos,true);
                
               for ($i=0; $i < count($proEnPresupuesto); $i++) { 

                    $producto = Producto::find($proEnPresupuesto[$i]['idProducto']);

                        if($producto->moneda == 'Dolares'){

                            if($cliente->facturacion == 'Si'){

                                $precioDolares = $producto->precioLocal;

                            }
     
                            else{
                                $precioDolares = $producto->precioLocalB;
                            }

                            $totalDolares = $totalDolares + ($precioDolares * $proEnPresupuesto[$i]['cantidad']);
             
                        }
                    
                    $detalle = new Detalle_Presupuesto();
                    
                    $detalle->presupuesto_id = $presupuesto->id;
                        
                    $detalle->producto_id = $proEnPresupuesto[$i]['idProducto'];
                        
                    $detalle->cantidad = $proEnPresupuesto[$i]['cantidad'];
                        
                    $detalle->precio = $proEnPresupuesto[$i]['precio'];

                    $detalle->precioDolares = $precioDolares;

                    $detalle->cotizacion =  $cajas->cotizacion;
                        
                    $detalle->save();
                }
            }

                $presupuesto2 = Presupuesto::find($presupuesto->id);
                $presupuesto2->num_comprobante= 'NPT-0'.Auth::user()->caja_id.'-'.date('Y').'-'.$presupuesto->id;
                $presupuesto2->totalDolares = $totalDolares;
                $presupuesto2->save();

            DB::commit();
        }

        catch(Exception $e){
        
        
            DB::rollback();
        }

        return redirect()->route('presupuestos.index')->with('success','Presupuesto agregado correctamente');
    }

    public function show($id)
    {
        $presupuesto = Presupuesto::find($id);

        $detalle = $presupuesto->detalle_presupuesto()->get();
 
        return view('presupuesto.show', ['presupuesto'=>$presupuesto,'detalle'=>$detalle]);
        
        //return view('presupuesto.show', compact('presupuesto'), compact('detalle'),compact('productos'));
    }

    public function listadoPresupuestos()
    {
        $presupuestos = Presupuesto::orderBy('id', 'DESC')->get();

        $pdf = PDF::loadView('pdf.presupuestospdf',['presupuestos'=>$presupuestos])->setPaper('a4', 'landscape');
    
        return $pdf->stream();
    }

    public function recivo ($id)
    {
        $presupuesto = Presupuesto::find($id);;

        $detalle = $presupuesto->detalle_presupuesto()->get();

        $pdf = PDF::loadView('pdf.presupuesto',['presupuesto'=>$presupuesto],['detalle'=>$detalle])->setPaper('a4', 'portrait');
    
        return $pdf->stream();
    }

}
