<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\Unidad_Negocio;
use App\Provincia;
use App\Rubro;
use DB;
use App\Pedido;
use App\Dolar;
use App\Cajas;
use App\Producto;
use App\MovimientoCaja;
use App\Pagos_Cuenta;
use App\Detalle_Pagos;
use App\Detalle_comision;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClienteExport;
use Illuminate\Http\Request;
use Validator,Hash,Auth,Str,Config,Image;
use Barryvdh\DomPDF\Facade as PDF;

class ClienteController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function home(Request $request)
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

        return view('clientes.home',$date);
    }

    public function create()
    {

        $provincias = Provincia::orderBy('nombre', 'ASC')->pluck('nombre','id');

        $date = ['provincias' => $provincias];

        return view('clientes.create',$date);
    }

    public function store(Request $request)
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

            $cliente2 = Cliente::findOrFail($cliente->id);
            $cliente2->num_cliente = 'NCT-'.$cliente->id ;

            if($cliente2->save()):
                return redirect()->route('clientes.index')->with('message','Cliente Registrado con exito','typealert','success');;
            endif;

        endif;

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
        $cliente->save();

        $cliente2 = Cliente::find($cliente->id);
        $cliente2->num_cliente = 'NCT-'.$cliente->id;
        $cliente2->save();

        return redirect()->route('pedidos.seleccionarNegocio',$cliente->id);
    }

    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $productosComprados = Producto::join('detalle_pedido','productos.id','=','detalle_pedido.producto_id')
        ->join('pedidos','detalle_pedido.pedido_id','=','pedidos.id')
        ->select('productos.imagen','productos.nombre',DB::raw('sum(detalle_pedido.cantidad) as cantidad'))
        ->where('pedidos.cliente_id','=',$id)
        ->groupBy('productos.nombre','productos.imagen')
        ->take(10)
        ->orderBy('cantidad','desc')                   
        ->get();

        $clientesPedidos = $cliente->pedidos();

        $clientesPedidos = $clientesPedidos->orderBy('id','desc')->paginate(10);

        $date = ['cliente' => $cliente,'productosComprados' => $productosComprados,'dolar'=> $dolar,'clientesPedidos'=>$clientesPedidos];

        return view('clientes.show', $date);
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
                
        $provincias = Provincia::orderBy('nombre', 'ASC')->pluck('nombre','id');

        $date = ['cliente' => $cliente ,'provincias' => $provincias];

        return view('clientes.edit', $date);
    }

    public function update(Request $request, $id)
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
            $cliente->cuit_cuil = e($request->input('cuit'));
            $cliente->email = e($request->input('email'));;
            $cliente->direccion = e($request->input('direccion'));;
            $cliente->ciudad = e($request->input('ciudad'));
            $cliente->codigo_postal = e($request->input('codigo_postal'));
            $cliente->genero = $request->genero;
            $cliente->tipo = $request->tipo;
            $cliente->provincia_id = $request->provincia_id;
            $cliente->rubro_id = 1;
            
            if (getValueJS(Auth::user()->permisosERP,'clientesCuentas')):
                $cliente->facturacion = $request->facturacion;
                $cliente->cuentaCorriente = $request->cuentaCorriente;
                $cliente->montoCuenta = e($request->input('montoCuenta'));
                $cliente->montoCuentaPesos = e($request->input('montoCuentaPesos'));
            endif;

            if($cliente->save()):

                $cliente2 = Cliente::find($cliente->id);

                $cliente2->num_cliente = 'NCT-'.$cliente->id ;
    
                if($cliente2->save()):

                    return back()->with('message','Cliente Actualizado con exito','typealert','success');
                
                endif;

            endif;

        endif;
    }


    public function reportePagosCliente($id){

        $pedidos = Cliente::join('pedidos','clientes.id','=','pedidos.cliente_id')
        ->join('movimiento_caja','pedidos.id','=','movimiento_caja.pedido_id')
        ->select('pedidos.num_pedido','movimiento_caja.forma')
        ->where('pedidos.cliente_id','=',$id)                 
        ->get();

        return $pedidos;
    }

    public function exportCliente(){

        return Excel::download(new ClienteExport(),'Listado_Clientes.xlsx');

    }

    public function cuentasCorriente()
    {
        $clientes = Cliente::where('cuentaCorriente','like','Si')->orderBy('nombre_fantasia', 'ASC')->paginate(10);
                
        return view('cuentas.index', compact('clientes'));
    }

    public function showCorriente($id)
    {
        $cliente = Cliente::find($id);

        //$caja = cajas::find(1);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $pedidos = Pagos_Cuenta::where('cliente_id','=',$id)
                                ->where('estado','like','Impago')
                                ->orderBy('id', 'asc')
                                ->get();

        $historial = Detalle_Pagos::where('cliente_id','=',$id)
                                ->orderBy('id', 'desc')
                                ->paginate(20);                         

        $totalDolares = Pagos_Cuenta::select(DB::raw('sum(montoRestante) as total'))
                                ->where('cliente_id','=',$id)
                                ->where('estado','like','Impago')
                                ->firstOrFail();
        
        $totalPesos = Pagos_Cuenta::select(DB::raw('sum(montoRestantePesos) as totalP'))
                                ->where('cliente_id','=',$id)
                                ->where('estado','like','Impago')
                                ->firstOrFail();

        $totalGeneral = ($totalDolares->total * $dolar->valor)+$totalPesos->total;
        
        return view('cuentas.show', compact('cliente','pedidos','totalDolares','totalPesos','dolar','totalGeneral','historial'));
    }

    public function historialPagos($id)
    {

        $pago = Pagos_Cuenta::find($id);

        $historial = Detalle_Pagos::where('pagos_id','=',$id)
                                    ->orderBy('id', 'desc')
                                    ->get(); 
        
        $cliente = Cliente::find($pago->cliente_id);
        
        return view('cuentas.historial', compact('cliente','pago','historial'));
    }

    public function historialClienteCorriente($id)
    {

        $cliente = Cliente::find($id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        //$caja = cajas::find(1);

        $pagos = Pagos_Cuenta::where('cliente_id','=',$id)->paginate(25);

        $totalDolares = Pagos_Cuenta::select(DB::raw('sum(montoRestante) as total'))
        ->where('cliente_id','=',$id)
        ->where('estado','like','Impago')
        ->firstOrFail();

        $totalPesos = Pagos_Cuenta::select(DB::raw('sum(montoRestantePesos) as totalP'))
        ->where('cliente_id','=',$id)
        ->where('estado','like','Impago')
        ->firstOrFail();

        $totalGeneral = ($totalDolares->total * $dolar->valor)+$totalPesos->total;

        return view('cuentas.historialCliente', compact('cliente','pagos','dolar','totalGeneral'));
    
    }
    

    public function storeCuenta(Request $request)
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();
        
        $pagos = Pagos_Cuenta::find($request->pagos_id);
                
        $pagos->montoRestante =  $pagos->montoRestante  -  $request->montodolares;

        $pagos->montoRestantePesos =  $pagos->montoRestantePesos -  $request->montop;
                
        $pagos->save();

       
        $detalle = new Detalle_Pagos();
        $detalle->pagos_id = $request->pagos_id;
        $detalle->cliente_id =  $pagos->cliente_id;
        $detalle->fecha = $mytime->toDateTimeString();
        $detalle->monto = $request->montodolares;
        $detalle->montop = $request->montop;
        $detalle->saldod = $pagos->montoRestante;
        $detalle->saldop = $pagos->montoRestantePesos;
        $detalle->cotizacion = $dolar->valor;
        $detalle->save();

                
                if($pagos->montoRestante <= 0 && $pagos->montoRestantePesos <= 0){
                    
                    $pago2 = Pagos_Cuenta::find($request->pagos_id);
                    $pago2->estado = 'pagado';
                    $pago2->save();

                    $mytime = Carbon::now('America/Argentina/Tucuman');
                    
                    $pedido = Pedido::find($pago2->pedido_id);
                    $pedido->fechaCancelacion = $mytime->toDateTimeString();
                    $pedido->pago = 'Pagado';
                    $pedido->save();
                }


                $cliente = Cliente::find($pagos->cliente_id);
            
                $cliente->montoCuenta = $cliente->montoCuenta + $request->montodolares;

                $cliente->montoCuentaPesos = $cliente->montoCuenta + $request->montop;
            
                $cliente->save();

                
                $cajas = Cajas::find(1);

                $totalPagado = $request->montod  + $request->montop;

                $cajas->saldoPesos = $cajas->saldoPesos + $totalPagado;

                $cajas->save();
                    
                
                $movimiento = new MovimientoCaja();

                    $movimiento->cajas_id = $cajas->id;

                    $movimiento->descripcion = 'Ingreso de Cuenta Corriente Venta Nº '. $pagos->pedido->num_pedido;

                    $movimiento->fecha = $mytime->toDateTimeString();

                    $movimiento->entrada = $totalPagado;

                    $movimiento->salida = '0';

                    $movimiento->moneda =  'Pesos';

                    $movimiento->tipo = 'Efectivo';

                    $movimiento->cotizacion = $dolar->valor;

                    $movimiento->saldoparcialpesos =  $cajas->saldoPesos;

                    $movimiento->saldoparcialdolares =  $request->montodolares;

                    $movimiento->save();
   
                return back();
    }

    public function imprimirHistorialPagosPedido(Request $request){

        $pedido = Pedido::find($request->pedido_id);

        $pagosPedidos = Pedido::join('movimiento_caja','pedidos.id','=','movimiento_caja.pedido_id')
        ->select('pedidos.num_pedido','movimiento_caja.id','movimiento_caja.entrada','movimiento_caja.forma','movimiento_caja.tipo','movimiento_caja.cuil_cheque','movimiento_caja.created_at')
        ->where('pedidos.id','=',$request->pedido_id)   
        ->orderBy('movimiento_caja.id','desc')                      
        ->get();

        $data = ['pedido' => $pedido, 'pagosPedidos'=> $pagosPedidos];

        $pdf = PDF::loadView('clientes.reportePagosPedido', $data)->setPaper('a4', 'landscape');
        
        return $pdf->stream();

    } 

    
}
