<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Pagos;
use App\Cajas;
use App\Dolar;
use App\MovimientoCaja;
use App\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PagosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index(Request $request)
    {
        $searchText = $request->searchText;

        $searchCondicion = $request->searchCondicion;

        
        if($searchCondicion && $searchText):
            
            if($searchCondicion == 'razon_Social'):
            
                $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                ->select('pedidos.num_pedido',
                            'pedidos.fecha',
                            'pedidos.cliente_id',
                            'pedidos.usuario_id',
                            'pedidos.estado',
                            'pedidos.pago',
                            'pedidos.id as id',
                            'pedidos.total',
                            'pedidos.modo_venta',
                            'pedidos.deposito_id')
                ->where('modo_venta','not like','Cuenta Corriente')
                ->where('deposito_id','=', Auth::user()->caja->deposito_id)
                ->where('pago','like', 'Impago')
                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                ->orderBy('id', 'DESC')
                ->paginate(200);
            
            else:

                $pedidos = Pedido::where($searchCondicion,'like','%'.$searchText.'%')
                ->where('modo_venta','not like','Cuenta Corriente')
                ->where('deposito_id','=', Auth::user()->caja->deposito_id)
                ->where('pago','like', 'Impago')
                ->orderBy('id', 'DESC')
                ->paginate(200);

            endif;

        else:

            $pedidos = Pedido::where('modo_venta','not like','Cuenta Corriente')
            ->where('deposito_id','=', Auth::user()->caja->deposito_id)
            ->where('pago','like', 'Impago')
            ->orderBy('id', 'DESC')
            ->paginate(30);

        endif;

        if(Auth::user()->tipo == 'munay'):
            return view('munay.pagos.index', compact('pedidos'));
        else:
            return view('pagos.index', compact('pedidos'));
        endif;
            
    }

    public function store(Request $request)
    {
        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $mytime = Carbon::now('America/Argentina/Tucuman');

        $pago = new Pagos();
        
        $pago->pedido_id = $request->pedidoid;
        
        $pago->monto = $request->total;
        
        $pago->vuelto = '0';        
            
        $pago->observaciones = $request->img;

        $pago->forma = $request->modo;

        $pago->save();

        
        $pedido = Pedido::find($request->pedidoid);

        $pedido->fechaCancelacion = $mytime->toDateTimeString();

        $pedido->pago = 'Pagado';

        $pedido->save();

        
        $cajas = Cajas::find(Auth::user()->caja_id);
        
        $cajas->saldoPesos = $cajas->saldoPesos + $request->total;

        $cajas->save();
                    
                
        $movimiento = new MovimientoCaja();

        $movimiento->cajas_id = Auth::user()->caja_id;

        $movimiento->pedido_id = $pedido->id;

        $movimiento->num_cheque = $request->num_cheque;

        $movimiento->cuil_cheque = $request->cuil_cheque;

        $movimiento->descripcion = 'Pago Final Venta N°'. $pedido->num_pedido;

        $movimiento->forma =  'Cancelatorio';

        $movimiento->fecha = $mytime->toDateTimeString();

        $movimiento->entrada = $request->total;

        $movimiento->salida = '0';

        $movimiento->moneda =  'Pesos';

        $movimiento->tipo = $request->modo;

        $movimiento->cotizacion = $dolar->valor;

        $movimiento->saldoparcialpesos =  $cajas->saldoPesos;

        $movimiento->saldoparcialdolares = $pedido->totalDolares;

        $movimiento->save();

        return redirect()->route('pagos.index')->with('success','producto actualizado correctamente');
    }

    public function pagoParcial($id){
        
        $pedido = Pedido::findOrFail($id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();
        
        $pagos = Pagos::where('pedido_id',$id)->get();

        $date = ['pedido' => $pedido, 'pagos' => $pagos, 'dolar' => $dolar];
        
        return view('pagos.pagoParcial', $date);

    }

    public function storeMixto(Request $request)
    {
       
        if($request->efectivo == null && $request->transferencia  == null &&  $request->cheque  == null &&  $request->tarjeta   == null &&  $request->mercado  == null){
            return back();
        }
        else{

            $mytime = Carbon::now('America/Argentina/Tucuman');

            $pago = new Pagos();
            
            $pago->pedido_id = $request->pedidoidMixto;
            
            $pago->monto = $request->totalMixto;
            
            $pago->vuelto = '0';        
                
            $pago->observaciones = 'Ninguno';

            $pago->forma = 'Efectivo';

            $pago->save();

            
            $pedido = Pedido::find($request->pedidoidMixto);

            $pedido->fechaCancelacion = $mytime->toDateTimeString();

            $pedido->pago = 'Pagado';

            $pedido->save();

            
            $cajas = Cajas::find(Auth::user()->caja_id);
            
            $cajas->saldoPesos = $cajas->saldoPesos + $request->totalMixto;

            $cajas->save();
                        
            if($request->efectivo != null){
                
                $this->crearMovimiento($pedido,$request->efectivo,'Efectivo',$cajas);
            }

            if($request->transferencia != null){
                
                $this->crearMovimiento($pedido,$request->transferencia,'Transferencia Bancaria',$cajas);
            }

            if($request->cheque != null){
                
                $this->crearMovimiento($pedido,$request->cheque,'Cheque',$cajas);
            }

            if($request->tarjeta != null){
                
                $this->crearMovimiento($pedido,$request->tarjeta,'tarjeta',$cajas);
            }

            if($request->mercado != null){
                
                $this->crearMovimiento($pedido,$request->mercado,'Mercado Pago',$cajas);
            }
            
            return redirect()->route('pagos.index')->with('success','producto actualizado correctamente');

        }
        
        
    }

    public function pagoParcialStore (Request $request,$id)
    {
        $dolar = Dolar::orderBy('id','desc')->firstOrFail();
       
        if($request->efectivo == null && $request->transferencia  == null &&  $request->cheque  == null &&  $request->tarjeta   == null &&  $request->mercado  == null){
            return back();
        }
        else{

            $mytime = Carbon::now('America/Argentina/Tucuman');

            $pago = new Pagos();
            
            $pago->pedido_id = $id;
            
            $pago->monto = $request->efectivo + $request->transferencia + $request->cheque  + $request->tarjeta + $request->mercado;
            
            $pago->vuelto = '0';        
                
            $pago->observaciones = 'Ninguno';

            $pago->forma = 'Efectivo';

            $pago->save();

            
            $pedido = Pedido::find($id);

            $pedido->pago_parcial = $pedido->pago_parcial + $pago->monto;

           // if($pedido->pago_parcial >= ( $pedido->deuda_pesos +   ($pedido->deuda_dolares * $dolar->valor) - $pedido->pago_parcial ) ):

           //     $pedido->fechaCancelacion = $mytime->toDateTimeString();

           //     $pedido->pago = 'Pagado';
            
          //  endif;

            $pedido->save();

            
            $cajas = Cajas::find(Auth::user()->caja_id);
            
            $cajas->saldoPesos = $cajas->saldoPesos + $pago->monto;

            $cajas->save();

            $pedido2 = Pedido::findOrFail($id);

            $saldo =  ( ( $pedido2->deuda_pesos + ($pedido2->deuda_dolares * $dolar->valor) ) - $pedido2->pago_parcial );

            if($request->efectivo != 0){
                
                $this->crearMovimientoParcial($pedido,$request->efectivo,'Efectivo',$cajas,$request->num_cheque,$request->cuil_cheque,$saldo);
            }

            if($request->transferencia != 0){
                
                $this->crearMovimientoParcial($pedido,$request->transferencia,'Transferencia Bancaria',$cajas,$request->num_cheque,$request->cuil_cheque,$saldo);
            }

            if($request->cheque != 0){
                
                $this->crearMovimientoParcial($pedido,$request->cheque,'Cheque',$cajas,$request->num_cheque,$request->cuil_cheque,$saldo);
            }

            if($request->tarjeta != 0){
                
                $this->crearMovimientoParcial($pedido,$request->tarjeta,'tarjeta',$cajas,$request->num_cheque,$request->cuil_cheque,$saldo);
            }

            if($request->mercado != 0){
                
                $this->crearMovimientoParcial($pedido,$request->mercado,'Mercado Pago',$cajas,$request->num_cheque,$request->cuil_cheque,$saldo);
            }
        
            if ( $saldo >  1):
    
                return back()->with('success','producto actualizado correctamente');
            
            else:
    
                $pedido2->fechaCancelacion = $mytime->toDateTimeString();
        
                $pedido2->pago = 'Pagado';
            
                $pedido2->save();
        
                return back()->with('message','EL PEDIDO PASO A PAGADO');
            
            endif;

        }
        
        
    }

    private function crearMovimientoParcial(Pedido $pedido,$monto,$forma,Cajas $cajas,$numCheque,$cuilCheque,$saldo){

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $mytime = Carbon::now('America/Argentina/Tucuman');

        $movimiento = new MovimientoCaja();

        $movimiento->pedido_id = $pedido->id;

        $movimiento->num_cheque = $numCheque;

        $movimiento->cuil_cheque = $cuilCheque;

        $movimiento->cajas_id = Auth::user()->caja_id;

        if ( $saldo >  1):
            $movimiento->descripcion = 'Pago Venta N°'. $pedido->num_pedido;

            $movimiento->forma =  'Parcial';
        else:
            $movimiento->descripcion = 'Pago Final  N°'. $pedido->num_pedido;

            $movimiento->forma =  'Cancelatorio';
        endif;

        $movimiento->fecha = $mytime->toDateTimeString();

        $movimiento->entrada = $monto;

        $movimiento->salida = '0';

        $movimiento->moneda =  'Pesos';

        $movimiento->tipo = $forma;

        $movimiento->cotizacion = $dolar->valor;

        $movimiento->saldoparcialpesos =  $cajas->saldoPesos;

        $movimiento->saldoparcialdolares = $pedido->totalDolares;

        $movimiento->save();

    }

    private function crearMovimiento(Pedido $pedido,$monto,$forma,Cajas $cajas){

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $mytime = Carbon::now('America/Argentina/Tucuman');

        $movimiento = new MovimientoCaja();

        $movimiento->cajas_id = Auth::user()->caja_id;

        $movimiento->descripcion = 'Pago Venta Nº '. $pedido->num_pedido;

        $movimiento->fecha = $mytime->toDateTimeString();

        $movimiento->entrada = $monto;

        $movimiento->salida = '0';

        $movimiento->moneda =  'Pesos';

        $movimiento->tipo = $forma;

        $movimiento->forma =  'Cancelatorio';

        $movimiento->cotizacion = $dolar->valor;

        $movimiento->saldoparcialpesos =  $cajas->saldoPesos;

        $movimiento->saldoparcialdolares = $pedido->totalDolares;

        $movimiento->save();

    }

    public function cerrar($id){

        $mytime = Carbon::now('America/Argentina/Tucuman');

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $pedido = Pedido::findOrFail($id);

        $saldo =  ( ( $pedido->deuda_pesos + ($pedido->deuda_dolares * $dolar->valor) ) - $pedido->pago_parcial );

        if ( $saldo >  1):

            return back()->with('message','Error, EL PEDIDO TIENE SALDO PENDIENTE');
        
        else:

            $pedido->fechaCancelacion = $mytime->toDateTimeString();
    
            $pedido->pago = 'Pagado';
        
            $pedido->save();
    
            return back()->with('message','EL PEDIDO PASO A PAGADO');

        endif;

    }

    public function recibos(Request $request)
    {
        $searchText = $request->searchText;

        $searchCondicion = $request->searchCondicion;

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        if($searchText):

            if($searchCondicion == 'cliente'):

                $clientes = Cliente::where('razon_Social','like','%'.$searchText.'%')->firstOrFail();

                $cli = Cliente::find($clientes->id);

                $pedidos = Pedido::join('movimiento_caja','pedidos.id','=','movimiento_caja.pedido_id')
                ->select('pedidos.*','movimiento_caja.tipo','movimiento_caja.num_cheque as numeroCheque')
                ->where('movimiento_caja.tipo','Cheque')
                ->where('pedidos.cliente_id',$clientes->id)
                ->orderBy('pedidos.id', 'DESC')
                ->paginate(100);
           

            else:
                $pedidos = Pedido::join('movimiento_caja','pedidos.id','=','movimiento_caja.pedido_id')
                ->select('pedidos.*','movimiento_caja.tipo','movimiento_caja.num_cheque as numeroCheque')
                ->where('movimiento_caja.tipo','Cheque')
                ->where('movimiento_caja.num_cheque',$searchText)
                ->orderBy('pedidos.id', 'DESC')
                ->paginate(100);
                
            endif;
            
        else:
                $pedidos = Pedido::join('movimiento_caja','pedidos.id','=','movimiento_caja.pedido_id')
                ->select('pedidos.*','movimiento_caja.tipo','movimiento_caja.num_cheque as numeroCheque')
                ->where('movimiento_caja.tipo','Cheque')
                ->orderBy('pedidos.id', 'DESC')
                ->paginate(25);
        endif;

        return view('pagos.recibos', compact('pedidos','dolar'));
            
    }



}
