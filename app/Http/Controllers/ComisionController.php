<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\User;
use App\Comision;
use App\Detalle_comision;
use Carbon\Carbon;
use App\ComisionesPagos;
use App\Cajas;
use App\Dolar;
use App\MovimientoCaja;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;


class ComisionController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    public function index()
    {

        //$vendedores = User::where('tipo','like','vendedor')->get();

        $usuarios = User::select('users.id','users.apellido','users.nombre')
         ->leftjoin('comisiones', 'users.id', '=', 'comisiones.usuario_id')
         ->where('users.tipo','like','vendedor')
         ->orWhere('users.tipo','like','vendedorcaja')
         ->where('users.estado','like','activo')
         ->whereNull('comisiones.id')
         ->get();

        $vendedores = DB::table('users')
        ->select('users.id','users.apellido','users.nombre','comisiones.porcentaje','comisiones.bonus','comisiones.valorBonus')
        ->leftJoin('comisiones', 'users.id', '=', 'comisiones.usuario_id')
        ->where('users.tipo','like','vendedor')
        ->orWhere('users.tipo','like','vendedorcaja')
        ->where('users.estado','like','activo')
        ->whereNotNull('comisiones.id')
        ->get();
        
        return view('comisiones.index', compact('vendedores','usuarios'));

    }

    public function show(Request $request,$id)
    {
        $vendedor = User::find($id);

        $comision = Comision::where('usuario_id','like',$id)->firstOrFail();;

        $searchText = $request->searchText;

        $ultimo = $request->searchTextHasta;

        $totalVendido = 0;

        $porcentaje = 0;

        $bonus = 0;

        $numero = 0;

        $totalBonus = 0;

        $totalComision = 0;

        $ventas;

        if($searchText){

            $ventas = Pedido::where('usuario_id','=',$id)
                      ->where('pago','like','Pagado')
                      ->whereDate('fechaCancelacion','>=',$searchText) 
                      ->whereDate('fechaCancelacion','<=',$ultimo) 
                      ->orderBy('id','desc')
                      ->get();

            $totalVendido = Pedido::select(DB::raw('sum(total) as totalPesos'))
                       ->where('usuario_id','=',$id)
                       ->where('pago','like','Pagado')
                       ->where('estado','not like','Cancelado')
                      ->whereDate('fechaCancelacion','>=',$searchText) 
                      ->whereDate('fechaCancelacion','<=',$ultimo) 
                      ->firstOrFail();
            
            $porcentaje = ($totalVendido->totalPesos * ($comision->porcentaje/100) );

            if($porcentaje >= $comision->bonus ){
                
                $bonus = ($porcentaje / $comision->bonus);

            }
            
            $numero = (int) $bonus;

            $totalBonus = $numero * $comision->valorBonus;

            $totalComision = $porcentaje + $totalBonus;

            $fechaComoEntero = strtotime($searchText);

            $countventas = $ventas->count();

            return view('comisiones.show', compact('vendedor','ventas','totalVendido','porcentaje','numero','totalBonus','totalComision','searchText','ultimo','fechaComoEntero','numero','countventas'));
            
        }

        else{
            return view('comisiones.showMes', compact('vendedor'));
        }
        
    }

    public function mostrarComisiones(Request $request){
        
        $searchText = $request->searchText;

        $ultimo = $request->searchTextHasta;
        
        if($searchText){
                    
            $ventas = Pedido::join('users','users.id','=','pedidos.usuario_id')
                        ->join('comisiones','comisiones.usuario_id','=','users.id')
                        ->select(DB::raw('sum(pedidos.total) as totalPesos'),
                        DB::raw('count(pedidos.total) as suma'),
                        'users.nombre',
                        'users.apellido',
                        'comisiones.bonus',
                        'comisiones.valorBonus',
                        'comisiones.porcentaje')
                        ->where('pedidos.pago','like','Pagado')
                        ->where('pedidos.estado','not like','Cancelado')
                        ->whereDate('fechaCancelacion','>=',$searchText) 
                        ->whereDate('fechaCancelacion','<=',$ultimo) 
                        ->groupBy('users.nombre','users.apellido','comisiones.bonus','comisiones.valorBonus','comisiones.porcentaje')
                        ->orderBy('suma','desc')
                        ->get();
                        
            return view('comisiones.comision', compact('ventas','searchText','ultimo'));
        }
        else{
            return view('comisiones.showMesGeneral');
        }
        
    }


    public function guardar(Request $request)
    {
        $comision = new Comision();
        $comision->usuario_id = $request->vendedor_id;
        $comision->porcentaje = $request->porcentaje;
        $comision->bonus = $request->bonus;
        $comision->valorBonus = $request->valorBonus;
        $comision->save();

        return redirect()->route('comisiones.index');
    }

    public function pagar(Request $request)
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');

        $fechaActual = Carbon::now('America/Argentina/Tucuman');

        $mesActual = $fechaActual->format('m/Y');

        $comisionPagos = new ComisionesPagos();
        $comisionPagos->usuario_id = $request->vendedor_id;
        $comisionPagos->totalVendido = $request->totalVenta;
        $comisionPagos->porcentajeVenta = $request->totalPorcentaje;
        $comisionPagos->bonus = $request->bonus;
        $comisionPagos->montoBonus = $request->totalBonus;
        $comisionPagos->comision = $request->totalComision;
        $comisionPagos->fechaDesde = $request->fechaDesde;
        $comisionPagos->fechaHasta = $request->fechaHasta;
        $comisionPagos->mes = $mesActual;
        $comisionPagos->estado = 'Pagado';
        $comisionPagos->save();

        $cajas = cajas::find(1);

        $cajas->saldoPesos = $cajas->saldoPesos - $request->totalComision;

        $cajas->save();

            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = $cajas->id;

            $movimiento->descripcion = 'Pago Vendedor ';

            $movimiento->fecha = $mytime->toDateTimeString();

            $movimiento->entrada = '0';

            $movimiento->salida = $request->totalComision;

            $movimiento->moneda =  'Pesos';

            $movimiento->tipo = $request->modoPago;

            $movimiento->saldoparcialpesos =  $cajas->saldoPesos;

            $movimiento->saldoparcialdolares = 0;

            $movimiento->cotizacion =  $dolar->valor;

            $movimiento->save();

        return redirect()->route('comisiones.index');
    }

    public function edit($id)
    {
        $vendedor = User::find( $id);

        $comision = Comision::where('usuario_id','=',$id)->firstOrFail();

        return view('comisiones.edit', compact('vendedor','comision'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comision = Comision::find($id);
        $comision->porcentaje = $request->porcentaje;
        $comision->bonus = $request->bonus;
        $comision->valorBonus = $request->valorBonus;
        $comision->save();

        return redirect()->route('comisiones.index');
    }

    public function imprimir($vendedor_id,$fechaDesde,$fechaHasta)
    {
        $vendedor = User::find($vendedor_id);

        $comision = Comision::where('usuario_id','like',$vendedor_id)->firstOrFail();;

        $searchText = $fechaDesde;

        $ultimo = $fechaHasta;

        $totalVendido = 0;

        $porcentaje = 0;

        $bonus = 0;

        $numero = 0;

        $totalBonus = 0;

        $totalComision = 0;

        $ventas = Pedido::where('usuario_id','=',$vendedor_id)
                      ->where('pago','like','Pagado')                    
                      ->whereDate('fechaCancelacion','>=',$searchText) 
                      ->whereDate('fechaCancelacion','<=',$ultimo)                    
                      ->orderBy('id','desc')
                      ->get();

        $totalVendido = Pedido::select(DB::raw('sum(total) as totalPesos'))
                        ->where('usuario_id','=',$vendedor_id)
                        ->where('pago','like','Pagado')
                        ->where('estado','not like','Cancelado')
                        ->whereDate('fechaCancelacion','>=',$searchText) 
                        ->whereDate('fechaCancelacion','<=',$ultimo) 
                        ->firstOrFail();
            
        $porcentaje = ($totalVendido->totalPesos * ($comision->porcentaje/100) );

        if($porcentaje >= $comision->bonus ){
                
                $bonus = ($porcentaje / $comision->bonus);

        }
            
        $numero = (int) $bonus;

        $totalBonus = $numero * $comision->valorBonus;

        $totalComision = $porcentaje + $totalBonus;

        $pdf = PDF::loadView('pdf.detalleComisiones',compact('vendedor','ventas','totalVendido','porcentaje','numero','totalBonus','totalComision','searchText','ultimo','numero'))->setPaper('a4','portrait');
    
        return $pdf->stream();

    }

    public function imprimiReporte($searchText,$ultimo){
        
        // $searchText = $request->searchText;
 
        // $ultimo = $request->searchTextHasta;
           
         $ventas = Pedido::join('users','users.id','=','pedidos.usuario_id')
                         ->join('comisiones','comisiones.usuario_id','=','users.id')
                         ->select(DB::raw('sum(pedidos.total) as totalPesos'),
                         DB::raw('count(pedidos.total) as suma'),
                         'users.nombre',
                         'users.apellido',
                         'comisiones.bonus',
                         'comisiones.valorBonus',
                         'comisiones.porcentaje')
                         ->where('pedidos.pago','like','Pagado')
                         ->where('pedidos.estado','not like','Cancelado')
                         ->whereDate('fechaCancelacion','>=',$searchText) 
                         ->whereDate('fechaCancelacion','<=',$ultimo) 
                         ->groupBy('users.nombre','users.apellido','comisiones.bonus','comisiones.valorBonus','comisiones.porcentaje')
                         ->orderBy('suma','desc')
                         ->get();
                         
         $pdf = PDF::loadView('comisiones.reporteGeneral',compact('ventas','searchText','ultimo'))->setPaper('a4','landscape');
     
         return $pdf->stream();
                         
     }

}
