<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Producto;
use App\Proveedor;
use App\OrdenCompra;
use App\Detalle_PresupuestoCompra;
use App\Pedido;
use App\Detalle_Pedido;
use App\Deposito;
use App\DepositoProducto;
use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Response;
use Illuminate\Support\Collection;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\Auth;

class OrdenCompraController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index(Request $request){
        
        $ordenes = OrdenCompra::orderBy('id', 'DESC')->paginate(10);
        
        return view('ordenCompra.index', compact('ordenes'));

    }

    public function create(){

        $productos = Producto::orderBy('id', 'DESC')->get();
        
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->get();
        
        return view('ordenCompra.create',["proveedores"=>$proveedores,"productos"=>$productos]);

    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $mytime = Carbon::now('America/Argentina/Tucuman');
            $ordenCompra = new OrdenCompra;
            $ordenCompra->proveedor_id = $request->get('idProveedor');
            $ordenCompra->usuario_id = Auth::user()->id;
            $ordenCompra->num_comprobante = 'OC ' .  date("Ymd-his");
            $ordenCompra->fecha = $mytime->toDateTimeString();
            $ordenCompra->total = $request->get('total_venta');
            $ordenCompra->tipo = $request->get('tipo');
            $ordenCompra->tipo = $request->get('fprmaPago');
            $ordenCompra->tipo = $request->get('cuenta');
            $ordenCompra->save();

            if (count( json_decode($request->productosEnCompra,true) ) > 0) {

               $proEnPresupuesto = json_decode($request->productosEnCompra,true);
                
               for ($i=0; $i < count($proEnPresupuesto); $i++) { 
                    $detalle = new Detalle_PresupuestoCompra();
                    $detalle->presupuestos_compras_id = $ordenCompra->id;
                    $detalle->producto_id = $proEnPresupuesto[$i]['idProducto'];
                    $detalle->cantidad = $proEnPresupuesto[$i]['cantidad'];
                    $detalle->precio = $proEnPresupuesto[$i]['precio'];
                    $detalle->save();
                }
            }
            DB::commit();
        }

        catch(Exception $e){
        
        
            DB::rollback();
        }

        return redirect()->route('ordenCompra.index')->with('success','Presupuesto agregado correctamente');
    }

    public function show($id)
    {
        $presupuesto = OrdenCompra::find($id);

        $detalle = $presupuesto->detalle_PresupuestoCompra()->get();
 
        return view('ordenCompra.show', ['presupuesto'=>$presupuesto,'detalle'=>$detalle]);
        
    }

    public function comprobante ($id)
    {
        $presupuesto = OrdenCompra::find($id);

        $detalle = $presupuesto->detalle_PresupuestoCompra()->get();

        $pdf = PDF::loadView('pdf.ordenDeCompra',['presupuesto'=>$presupuesto],['detalle'=>$detalle])->setPaper('a4', 'landscape');
    
        return $pdf->stream();
    }

    public function comprobantePago ($id)
    {
        $presupuesto = OrdenCompra::find($id);
        $mytime = Carbon::now('America/Argentina/Tucuman');
        $presupuesto->fechaPago = $mytime->toDateTimeString();
        $presupuesto->save();

        $detalle = $presupuesto->detalle_PresupuestoCompra()->get();

        $pdf = PDF::loadView('pdf.ordenDePago',['presupuesto'=>$presupuesto],['detalle'=>$detalle])->setPaper('a4', 'landscape');
    
        return $pdf->stream();
    }




}
