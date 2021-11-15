<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Cajas;
use App\Dolar;
use App\Movimiento_Tarea;
use App\Tarea;
use App\MovimientoCaja;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class OrdenController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    public function getOrdenes($status,$forma){

        if($status == 'all'):
        
            if($forma == 'all'):
        
                $orders = Order::where('status','!=','0')->with(['getUser'])->orderBy('o_number','DESC')->paginate(25);
            
            else:
            
                $orders = Order::where('status','!=','0')->where('forma_envio',$forma)->with(['getUser'])->orderBy('o_number','DESC')->paginate(25);
            
            endif;
        
        else:

            if($forma == 'all'):
        
                $orders = Order::where('status','=', $status)->with(['getUser'])->orderBy('o_number','DESC')->paginate(25);
        
            else:
        
                $orders = Order::where('status','=', $status)->where('forma_envio',$forma)->with(['getUser'])->orderBy('o_number','DESC')->paginate(25);
        
            endif;
        
        endif;

        $all_orders = Order::all();

        $data = ['orders' => $orders,'status' => $status,'forma' => $forma,'all_orders' => $all_orders];

        return view('ordenes.list',$data);

    }

    public function getOrden($id){

        $order = Order::findOrFail($id);

        $data = ['order' => $order];

        return view('ordenes.details',$data);

    } 

    public function postUpdateStatus($id,Request $request){


        $order = Order::findOrFail($id);

        $oldStatus = $order->status;

        $order->status = $request->status;

        if($order->save()):

            if($order->status == 2 ):
            
                $dolar = Dolar::orderBy('id','desc')->firstOrFail();

                $mytime = Carbon::now('America/Argentina/Tucuman');

                $cajas = Cajas::find(Auth::user()->caja_id);
                
                $cajas->saldoPesos = $cajas->saldoPesos + $order->total;

                if($cajas->save()):
                            
                    $movimiento = new MovimientoCaja();

                    $movimiento->pedido_id = $order->id;
            
                    $movimiento->num_cheque = 0;
            
                    $movimiento->cuil_cheque = 0;
            
                    $movimiento->cajas_id = Auth::user()->caja_id;
            
                    $movimiento->descripcion = 'Pago Orden Eccomerce N°'. $order->o_number;
            
                    $movimiento->forma =  'Total';

                    $movimiento->fecha = $mytime->toDateTimeString();
            
                    $movimiento->entrada = $order->total;
            
                    $movimiento->salida = '0';
            
                    $movimiento->moneda =  'Pesos';
            
                    $movimiento->tipo = getPaymentsMethods($order->payment_method);
            
                    $movimiento->cotizacion = $dolar->valor;
            
                    $movimiento->saldoparcialpesos =  $cajas->saldoPesos;
            
                    $movimiento->saldoparcialdolares = 0;
            
                    if($movimiento->save()):

                        $tarea = new Tarea;
                        $tarea->detalle = 'Preparar Orden Eccomerce N°'. $order->o_number;
                        $tarea->estado = 'pendiente';
                        $tarea->prioridad = 'urgencia';
                        $tarea->fecha_inicio = date('Y-m-d H:i:s');
                        $tarea->tipo_tarea_id = 2;
                        $tarea->user_id = 5;
                        $tarea->orden_id = $order->id;
                        $tarea->save();
                
                        $movimientotarea = new Movimiento_Tarea;
                        $movimientotarea->observaciones = 'Asignada';
                        $movimientotarea->fecha_movimiento = date('Y-m-d H:i:s');
                        $movimientotarea->tarea_id = $tarea->id;
                        $movimientotarea->user_id = 5;
                        $movimientotarea->save();

                        return back()->with('message','Estado Actualizado con exito')->with('typealert','success');;

                    endif;

                endif;

            endif;
        
        endif;

        return back()->with('message','Estado Actualizado con exito')->with('typealert','success');;

    }

    public function ordenSearch(Request $request){

        $orders = Order::where('o_number','like','%'.$request->searchText.'%')->paginate(200);       
                            
        $all_orders = Order::all();

        $data = ['orders' => $orders,'status' => 'all','forma' => 'all','all_orders' => $all_orders];

        return view('ordenes.search',$data);

    }
}
