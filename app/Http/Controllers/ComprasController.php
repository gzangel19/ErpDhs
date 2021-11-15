<?php

namespace App\Http\Controllers;

use App\Compra;
use Illuminate\Http\Request;
use App\Proveedor;
use App\Producto;
use App\Detalle_Compra;
use App\Deposito;
use App\DepositoProducto;
use App\MovimientoDeposito;
use DB;
use Carbon\Carbon;
use Response;
use App\HistorialMovimientos;
use Illuminate\Support\Collection;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\Auth;


class ComprasController extends Controller
{
    public function index(Request $request){
        
        $compras = Compra::orderBy('id', 'DESC')->paginate(10);
        
        return view('compras.index', compact('compras'));

    }

    public function create(){

        $productos = Producto::all();
    
        $proveedores = Proveedor::orderBy('id', 'ASC')->get();

        $depositos = Deposito::orderBy('id', 'ASC')->where('id','<>','1')->get();

        return view('compras.create',['productos'=> $productos,'proveedores'=>$proveedores,'depositos'=>$depositos]);

    }
    
    public function store(Request $request)
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');

        try{
            DB::beginTransaction();
            $mytime = Carbon::now('America/Argentina/Tucuman');
            $compra = new Compra();
            $compra->proveedor_id = $request->get('idProveedor');
            $compra->usuario_id = Auth::user()->id;
            $compra->deposito_id = $request->get('deposito_id');
            $compra->num_compra=  date("Ymd-his");
            $compra->fecha = $mytime->toDateTimeString();
            $compra->total = $request->get('total_venta');
            $compra->tipo = $request->get('tipo');

            if($request->hasFile('img'))
            {
                $file = $request->file('img');
                $uniqueFileName = $compra->num_compra. '.' . $file->getClientOriginalExtension();
                $destino = public_path('img/productos');
                $request->img->move($destino,$uniqueFileName);         
                $producto->imagen = $uniqueFileName;
            }

            $compra->save();

            if (count( json_decode($request->productosEnCompra,true) ) > 0) {

               $proEnPedido = json_decode($request->productosEnCompra,true);
                
               for ($i=0; $i < count($proEnPedido); $i++) { 

                    //CARGA LA LINEA DE PEDIDO
                    $detalle = new Detalle_Compra();
                    $detalle->compra_id = $compra->id;
                    $detalle->producto_id = $proEnPedido[$i]['idProducto'];
                    $detalle->cantidad = $proEnPedido[$i]['cantidad'];
                    $detalle->precio = $proEnPedido[$i]['precio'];
                    $detalle->save();

                    //VERIFICA SI EL DEPOSITO TIENE ESE PRODUCTO//
                    
                    $depositoPedido = DepositoProducto::where('producto_id','like',$detalle->producto_id)
                    ->where('deposito_id','like', $compra->deposito_id)
                    ->get();
                    
                    //si ese deposito no cuenta con el pedido no locrea
                    if($depositoPedido->isEmpty()){
                        $deposito = new DepositoProducto();
                        $deposito->stock =  $detalle->cantidad;
                        $deposito->stock_reservado =  0;
                        $deposito->stock_critico = 0;
                        $deposito->ubicacion = 'Estanterias';
                        $deposito->deposito_id =  $compra->deposito_id ;
                        $deposito->producto_id =  $detalle->producto_id;
                        $deposito->save();
                    }  
                    //si ese deposito tiene al producto le suma el stock
                    else{
                        $depositoDestino = DepositoProducto::where('producto_id','like',$detalle->producto_id)
                                                            ->where('deposito_id','like', $compra->deposito_id)
                                                            ->firstOrFail();
                        $depositoDestino->stock = $depositoDestino->stock + $detalle->cantidad;
                        $depositoDestino->save();
                    }

                }
            }

           
            DB::commit();
        }

        catch(Exception $e){
        
        
            DB::rollback();
        }

        return redirect()->route('compras.index')->with('success','Presupuesto agregado correctamente');
    }

    public function show($id)
    {
        $compra = Compra::find($id);

        $detalle = $compra->detalle_compra()->get();
   
        return view('compras.show', ['compra'=>$compra,'detalle'=>$detalle]);
    }

    public function movimientoPedido($id){

        $pedido = pedido::find($id);
        $pedido->estado = "En Deposito";
        $pedido->save();

        $detalle = $pedido->detalle_pedido()->get();

        if (count( json_decode($detalle,true) ) > 0) {

            $detEnPedido = json_decode($detalle,true);
            $mytime = Carbon::now('America/Argentina/Tucuman');

            for ($i=0; $i < count($detEnPedido); $i++) { 
                
                //SE REALIZA EL MOVIMIENTO DE LOS PRODUCTOS AL DEPOSITO OSCURO//
                
                $movimiento = new MovimientoDeposito();
                $movimiento->idpedido = $id;
                $movimiento->idDepositoOrigen = $detEnPedido[$i]['deposito_id'];
                $movimiento->idDepositoDestino = 1;
                $movimiento->idProducto = $detEnPedido[$i]['producto_id'];
                $movimiento->cantidad = $detEnPedido[$i]['cantidad'];
                $movimiento->save();

                //RESTA DEL STOCK RESERVADO DEL ORIGINAL //


                $depositoOrigen = DepositoProducto::where('producto_id','like',$movimiento->idProducto)
                ->where('deposito_id','like',$movimiento->idDepositoOrigen )
                ->firstOrFail();
                $depositoOrigen->stock_reservado = $depositoOrigen->stock_reservado -   $movimiento->cantidad;
                $depositoOrigen->save();

                //VERIFICA SI EXISTE ESE PRODUCTO EN EL DEPOSITO OSCURO//

                $depositoPedido = DepositoProducto::where('producto_id','like',$movimiento->idProducto)
                                                  ->where('deposito_id','like','1')
                                                  ->get();
                                                  
                //SI NO EXISTE, LO CREA
                if($depositoPedido->isEmpty())
                {
                    $depPedi = new DepositoProducto();
                    $depPedi->stock = $movimiento->cantidad;
                    $depPedi->stock_reservado =  0;
                    $depPedi->stock_critico = 0;
                    $depPedi->ubicacion = 'Estanterias';
                    $depPedi->deposito_id = 1;
                    $depPedi->producto_id = $movimiento->idProducto;
                    $depPedi->save();
                }  

                //SI EXISTE LE AUMENTA STOCK
                else
                {

                    $depositoPedido2 = DepositoProducto::where('producto_id','like',$movimiento->idProducto)
                                                        ->where('deposito_id','like','1')
                                                        ->firstOrFail();
                    $depositoPedido2->stock = $depositoPedido2->stock +   $movimiento->cantidad;
                    $depositoPedido2->save();
                }                           

            }
        }
        return redirect()->route('pedidos.entregar');
    }

}
