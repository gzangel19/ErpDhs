<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cliente;
use App\Pedido;
use App\Producto;
use App\DepositoProducto;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(Auth::user()->tipo == 'munay'){
            return view('homeMunay');
        }
        if(Auth::user()->tipo == 'sinopsys'){
            return view('homeSinopsys');
        }

        if(Auth::user()->tipo == 'admin'){

            $fechaActual = Carbon::now('America/Argentina/Tucuman');

            // Estadisticas Casa Central //

            $productosCasaCentral = DepositoProducto::where('deposito_id','2')->count();
            $productosSinStockCasaCentral = DepositoProducto::where('deposito_id','2')->where('stock','<=',0)->count();
            $pedidosPendientesCasaCentral = Pedido::where('deposito_id','2')->where('estado','like','Preparando')->count();
            $pedidosImpagos = Pedido::where('deposito_id','2')->where('pago','like','Impago')->count();
            $totalPedidosCasaCentral =  Pedido::get()->where('deposito_id','2')->where('pago','like','Pagado')->count();
            $totalIngresosCasaCentral =  Pedido::get()->where('deposito_id','2')->where('pago','like','Pagado')->sum('total');
            $promedioTicketCasaCentral = $totalIngresosCasaCentral / $totalPedidosCasaCentral;

            $ventasMeses = self::ventasMensuales();

            $meses = Pedido::select(DB::raw("Month(fechaCancelacion) as mes"),DB::raw("COUNT(*) as total"))
                    ->whereYear('fechaCancelacion','2021')
                    ->where('estado','not like','Cancelado')
                    ->where('pago','like','Pagado')
                    ->where('deposito_id','=','2')
                    ->groupBy(DB::raw("Month(fechaCancelacion)"))
                    ->orderBy(DB::raw("Month(fechaCancelacion)"),'ASC')
                    ->pluck('mes'); 

            $totalMeses = Pedido::select(DB::raw("Month(fechaCancelacion) as mes"),DB::raw("sum(total) as total"))
                    ->where('pago','like','Pagado')
                    ->whereYear('fechaCancelacion','2021')
                    ->where('estado','not like','Cancelado')
                    ->where('pago','like','Pagado')
                    ->where('deposito_id','=','2')
                    ->groupBy(DB::raw("Month(fechaCancelacion)"))
                    ->orderBy(DB::raw("Month(fechaCancelacion)"),'ASC')
                    ->pluck('total');

            // Estadisticas Mate de Luna //

            $ventasMesesSucursal2 = self::ventasMensualesSucursal2();

            $productosMatedeLuna = DepositoProducto::where('deposito_id','3')->count();
            $productosSinStockMatedeLuna = DepositoProducto::where('deposito_id','3')->where('stock','<=',0)->count();
            $pedidosPendientesMatedeLuna = Pedido::where('deposito_id','3')->where('estado','like','Preparando')->count();
            $pedidosImpagosMatedeLuna = Pedido::where('deposito_id','3')->where('pago','like','Impago')->count();
            $totalPedidosMatedeLuna =  Pedido::get()->where('deposito_id','3')->where('pago','like','Pagado')->count();
            $totalIngresosMatedeLuna =  Pedido::get()->where('deposito_id','3')->where('pago','like','Pagado')->sum('total');
            
            if($totalIngresosMatedeLuna != 0):

                $promedioTicketMatedeLuna = $totalIngresosMatedeLuna / $totalPedidosMatedeLuna;

            else:
                $promedioTicketMatedeLuna = 0;
            endif;

            $mesesSucursal2 = Pedido::select(DB::raw("Month(fechaCancelacion) as mes"),DB::raw("COUNT(*) as total"))
            ->whereYear('fechaCancelacion','2021')
            ->where('estado','not like','Cancelado')
            ->where('pago','like','Pagado')
            ->where('deposito_id','=','3')
            ->groupBy(DB::raw("Month(fechaCancelacion)"))
            ->orderBy(DB::raw("Month(fechaCancelacion)"),'ASC')
            ->pluck('mes'); 

            $totalMesesSucursal2 = Pedido::select(DB::raw("Month(fechaCancelacion) as mes"),DB::raw("sum(total) as total"))
                        ->where('pago','like','Pagado')
                        ->whereYear('fechaCancelacion','2021')
                        ->where('estado','not like','Cancelado')
                        ->where('pago','like','Pagado')
                        ->where('deposito_id','=','3')
                        ->groupBy(DB::raw("Month(fechaCancelacion)"))
                        ->orderBy(DB::raw("Month(fechaCancelacion)"),'ASC')
                        ->pluck('total');
                    
                    
            // Estadisticas Santiago del Estero //

            
                $productosSantiago = DepositoProducto::where('deposito_id','6')->count();
                $productosSinStockSantiago = DepositoProducto::where('deposito_id','6')->where('stock','<=',0)->count();
                $pedidosPendientesSantiago = Pedido::where('deposito_id','6')->where('estado','like','Preparando')->count();
                $pedidosImpagosSantiago = Pedido::where('deposito_id','6')->where('pago','like','Impago')->count();
                $totalPedidosSantiago =  Pedido::get()->where('deposito_id','6')->where('pago','like','Pagado')->count();
                $totalIngresosSantiago =  Pedido::get()->where('deposito_id','6')->where('pago','like','Pagado')->sum('total');
                        
                if($totalIngresosSantiago != 0):
            
                    $promedioTicketSantiago = $totalIngresosSantiago / $totalPedidosSantiago;
            
                else:
                    $promedioTicketSantiago = 0;
                        
                endif;

               

                $ventasMesesSucursal6 = self::ventasMensualesSucursal6();
                            
                $mesesSucursal6 = Pedido::select(DB::raw("Month(fechaCancelacion) as mes"),DB::raw("COUNT(*) as total"))
                                ->whereYear('fechaCancelacion','2021')
                                ->where('estado','not like','Cancelado')
                                ->where('pago','like','Pagado')
                                ->where('deposito_id','=','6')
                                ->groupBy(DB::raw("Month(fechaCancelacion)"))
                                ->orderBy(DB::raw("Month(fechaCancelacion)"),'ASC')
                                ->pluck('mes'); 

                $totalMesesSucursal6 = Pedido::select(DB::raw("Month(fechaCancelacion) as mes"),DB::raw("sum(total) as total"))
                                ->where('pago','like','Pagado')
                                ->whereYear('fechaCancelacion','2021')
                                ->where('estado','not like','Cancelado')
                                ->where('pago','like','Pagado')
                                ->where('deposito_id','=','6')
                                ->groupBy(DB::raw("Month(fechaCancelacion)"))
                                ->orderBy(DB::raw("Month(fechaCancelacion)"),'ASC')
                                ->pluck('total');
                                

            // Estadisticas Generales //

            $searchVentasDiarias = $request->ventasmes;
            $searchVentasDiariasVendedor = $request->ventasmesVendedor;
            $searchVendedorId = $request->vendedor_id;

            if($searchVentasDiarias){
                $mesActual = $searchVentasDiarias;
            }
            else{
                $mesActual = $fechaActual->format('m');

            }

            if($searchVendedorId){
                $mesActualVendedor = $searchVentasDiariasVendedor;
                $vendedor = User::find($searchVendedorId);
            }
            else{
                $mesActualVendedor = $fechaActual->format('m');
                $vendedor = User::find(6);
            }
            
            $vendedores = User::select('users.id','users.apellido','users.nombre')
            ->where('users.tipo','like','vendedor')
            ->get();
     
        
            $totalMesesVendedores = Pedido::select(DB::raw("Month(fechaCancelacion) as mes"),DB::raw("sum(total) as total"))
                            ->where('pago','like','Pagado')
                            ->whereYear('fechaCancelacion','2021')
                            ->where('estado','not like','Cancelado')
                            ->where('pago','like','Pagado')
                            ->where('estado','not like','Cancelado')
                            ->groupBy(DB::raw("Month(fechaCancelacion)"))
                            ->orderBy(DB::raw("Month(fechaCancelacion)"),'ASC')
                            ->pluck('total');                    
            
           
            $dias = self::ventasDiarias($mesActual);

            $totalDias = self::fechasDias($mesActual);

            $ventasDiariasVendedor = self::ventasDiariasVendedor($mesActualVendedor,$vendedor->id);

            $totalDiasVendedor = self::fechasDiasVendedor($mesActualVendedor,$vendedor->id);

            $sumaDiaVendedor = self::sumaDiariasVendedor($mesActualVendedor,$vendedor->id);
            
            $sumDias = Pedido::select(DB::raw("DATE(fechaCancelacion) as dia"),DB::raw("sum(total) as total"))
                            ->whereYear('fechaCancelacion','2021')
                            ->whereMonth('fechaCancelacion','=',$mesActual)
                            ->where('pago','like','Pagado')
                            ->where('estado','not like','Cancelado')
                            ->groupBy('dia')
                            ->orderBy('dia','ASC')
                            //->get();
                            ->pluck('total'); 

            $pedidoTotal = Pedido::count();

            $pedidoCancelado = self::ventasEstado($estado = 'Cancelado'); 
            $pedidoEntregado = self::ventasEstado($estado = 'Entregado'); 
            $pedidoPreparando = self::ventasEstado($estado = 'Preparando');
            $pedidoReparto = self::ventasEstado($estado = 'En Reparto'); 

            $pedidoPagados = Pedido::where('pago','like','Pagado')
                            ->where('estado','not like','Cancelado')
                            //->whereMonth('fecha','=',$mesActual)
                            ->count();

            $pedidoImpagos = Pedido::where('pago','like','Impago')
                                   // ->whereMonth('fecha','=',$mesActual)
                                    ->count();

            $pedidoEfectivo = Pedido::where('modo_venta','like','Efectivo')
                                    ->where('estado','not like','Cancelado')
                                   //// ->whereMonth('fecha','=',$mesActual)
                                    ->count();
            
            $pedidoTransferencia = Pedido::where('modo_venta','like','Transferencia Bancaria')
                                        ->where('estado','not like','Cancelado')
                                        ////->whereMonth('fecha','=',$mesActual)
                                        ->count();

            $pedidoCheque = Pedido::where('modo_venta','like','Cheque')
                                    ->where('estado','not like','Cancelado')
                                   // ->whereMonth('fecha','=',$mesActual)
                                    ->count();

            $pedidoCuenta = Pedido::where('modo_venta','like','Cuenta Corriente')
                                    ->where('estado','not like','Cancelado')
                                    //->whereMonth('fecha','=',$mesActual)
                                    ->count();


            $porcentajeCancelado = ($pedidoCancelado * 100) / Pedido::count();
            $porcentajeEntregado = ($pedidoEntregado * 100) / Pedido::count();
            $porcentajePreparando = ($pedidoPreparando * 100) / Pedido::count();
            $porcentajeReparto = ($pedidoReparto * 100) / Pedido::count();

            $porcentajePagado = ($pedidoPagados * 100) / Pedido::count();
            $porcentajeImPagado = ($pedidoImpagos * 100) / Pedido::count();

            $porcentajeEfectivo = ($pedidoEfectivo * 100) / Pedido::count();
            $porcentajeTransferencia = ($pedidoTransferencia * 100) / Pedido::count();
            $porcentajeCheque = ($pedidoCheque * 100) / Pedido::count();
            $porcentajeCuenta = ($pedidoCuenta * 100) / Pedido::count();

            return view('home',compact('porcentajeCancelado','porcentajeEntregado','porcentajePreparando','porcentajeReparto','pedidoTotal','pedidoEntregado','pedidoPreparando','pedidoCancelado','pedidoReparto',
                                        'porcentajePagado','porcentajeImPagado','pedidoPagados','pedidoImpagos','pedidoEfectivo','pedidoTransferencia','pedidoCheque','pedidoCuenta','porcentajeEfectivo','porcentajeTransferencia','porcentajeCheque','porcentajeCuenta',
                                        'ventasMeses','totalMeses','meses','mesesSucursal2','dias','totalDias','sumDias','ventasDiariasVendedor','totalDiasVendedor','vendedores','vendedor','sumaDiaVendedor','ventasMesesSucursal2','totalMesesSucursal2','productosCasaCentral','productosSinStockCasaCentral',
                                        'pedidosPendientesCasaCentral','pedidosImpagos','totalIngresosCasaCentral','totalPedidosCasaCentral','promedioTicketCasaCentral','productosMatedeLuna','productosSinStockMatedeLuna',
                                        'pedidosPendientesMatedeLuna','pedidosImpagosMatedeLuna','totalIngresosMatedeLuna','totalPedidosMatedeLuna','promedioTicketMatedeLuna','productosSantiago','productosSinStockSantiago',
                                        'pedidosPendientesSantiago','pedidosImpagosSantiago','totalIngresosSantiago','totalPedidosSantiago','promedioTicketSantiago','ventasMesesSucursal6','mesesSucursal6','ventasMesesSucursal6','totalMesesSucursal6'));
        }
        else{
    
            return view('homeVendedor');
        
        }
        
    }

    private function ventasMensualesSucursal6(){
        
        return Pedido::select(DB::raw("Month(fechaCancelacion) as mes"),DB::raw("COUNT(*) as total"))
              ->whereYear('fechaCancelacion','2021')
              ->where('estado','not like','Cancelado')
              ->where('pago','like','Pagado')
              ->where('deposito_id','=','6')
              ->groupBy(DB::raw("Month(fechaCancelacion)"))
              ->orderBy(DB::raw("Month(fechaCancelacion)"),'ASC')                        
              ->pluck('total');
    }

    private function ventasMensualesSucursal2(){
        
        return Pedido::select(DB::raw("Month(fechaCancelacion) as mes"),DB::raw("COUNT(*) as total"))
              ->whereYear('fechaCancelacion','2021')
              ->where('estado','not like','Cancelado')
              ->where('pago','like','Pagado')
              ->where('deposito_id','=','3')
              ->groupBy(DB::raw("Month(fechaCancelacion)"))
              ->orderBy(DB::raw("Month(fechaCancelacion)"),'ASC')                        
              ->pluck('total');
    }

    private function ventasMensuales(){
        
        return Pedido::select(DB::raw("Month(fechaCancelacion) as mes"),DB::raw("COUNT(*) as total"))
              ->whereYear('fechaCancelacion','2021')
              ->where('estado','not like','Cancelado')
              ->where('pago','like','Pagado')
              ->where('deposito_id','=','2')
              ->groupBy(DB::raw("Month(fechaCancelacion)"))
              ->orderBy(DB::raw("Month(fechaCancelacion)"),'ASC')                        
              ->pluck('total');
    }

    private function ventasDiarias($mes){
        return Pedido::select(DB::raw("DATE(fechaCancelacion) as dia"),DB::raw("COUNT(*) as total"))
                            ->whereYear('fechaCancelacion','2021')
                            ->whereMonth('fechaCancelacion','=',$mes)
                            ->where('pago','like','Pagado')
                            ->where('estado','not like','Cancelado')
                            ->groupBy('dia')
                            ->orderBy('dia','ASC')
                            ->pluck('dia'); 
    }

    private function fechasDias($mes){
        return Pedido::select(DB::raw("DATE(fechaCancelacion) as dia"),DB::raw("count(total) as total"))
                            ->whereYear('fechaCancelacion','2021')
                            ->whereMonth('fechaCancelacion','=',$mes)
                            ->where('pago','like','Pagado')
                            ->where('estado','not like','Cancelado')
                            ->groupBy('dia')
                            ->orderBy('dia','ASC')
                            ->pluck('total'); 
    }

    private function ventasDiariasVendedor($mes,$id){
                return Pedido::select('usuario_id',DB::raw("DATE(fechaCancelacion) as dia"),DB::raw("count(total) as total"))
                            ->whereYear('fechaCancelacion','2021')
                            ->whereMonth('fechaCancelacion','=',$mes)
                            ->where('estado','not like','Cancelado')
                            ->where('usuario_id','=',$id)
                            ->groupBy('dia','usuario_id')
                            ->orderBy('dia','ASC')
                            ->pluck('total'); 
    }

    private function sumaDiariasVendedor($mes,$id){
        return Pedido::select('usuario_id',DB::raw("DATE(fechaCancelacion) as dia"),DB::raw("sum(total) as total"))
                    ->whereYear('fechaCancelacion','2021')
                    ->whereMonth('fechaCancelacion','=',$mes)
                    ->where('estado','not like','Cancelado')
                    ->where('usuario_id','=',$id)
                    ->groupBy('dia','usuario_id')
                    ->orderBy('dia','ASC')
                    ->pluck('total'); 

    }
    
    private function fechasDiasVendedor($mes,$id){
        return Pedido::select('usuario_id',DB::raw("DATE(fechaCancelacion) as dia"),DB::raw("count(total) as total"))
                ->whereYear('fechaCancelacion','2021')
                ->whereMonth('fechaCancelacion','=',$mes)
                ->where('estado','not like','Cancelado')
                ->where('usuario_id','=',$id)
                ->groupBy('dia','usuario_id')
                ->orderBy('dia','ASC')
                ->pluck('dia');
    }

    private function ventasEstado($estado){
        return Pedido::where('estado','like',$estado)->count();
    }
}
