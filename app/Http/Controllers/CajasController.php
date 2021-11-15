<?php

namespace App\Http\Controllers;
use App\Categoria;
use App\Cajas;
use App\Dolar;
use App\MovimientoCaja;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CajasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    public function index()
    {
        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $cajas = Cajas::orderBy('id', 'ASC')->paginate(10); 

        $caja = Cajas::find(Auth::user()->caja_id);

        if(Auth::user()->tipo == 'admin'):

            return view('cajas.index', compact('cajas','caja','dolar'));

        else:

            $mytime = Carbon::now('America/Argentina/Tucuman');

            $dia = $mytime->toDateTimeString();
    
            $fechaApertura = MovimientoCaja::where('cajas_id','like',Auth::user()->caja_id)
            ->where('descripcion','like' ,'Apertura de Caja')
            ->orderBy('id','DESC')
            ->firstOrFail();
    
            $movimientos = MovimientoCaja::where('cajas_id','like',Auth::user()->caja_id)
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia))
            ->orderBy('id','DESC')
            ->get();
    
            $total = MovimientoCaja::count();
    
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
    
            return view('cajas.vendedor', compact('cajas','caja','dolar','movimientos'));
        
        endif;

    }

    // MUESTRA LA VENTANA DE ABRIR CAJA //

    public function show($id)
    {
        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $cajas = Cajas::find($id);

        $movimientos = MovimientoCaja::where('cajas_id','like',$id)->orderBy('id','DESC')->paginate(10);

        $total = MovimientoCaja::count();

        // SI ES LA PRIMERA VEZ QUE SE ABRE LA CAJA CREA ESTA LINEA POR DEFECTO //

        if($total == 0){

            $mytime = Carbon::now('America/Argentina/Tucuman');

            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = $id;

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
           
        return view('cajas.detalle', compact('cajas','movimientos'));

    }

    // DETALLE DE CAJA DIARIO //

    public function diario(Request $request,$id)
    {
        $cajas = Cajas::find($id);

        $mytime = Carbon::now('America/Argentina/Tucuman');

        $dia = $mytime->toDateTimeString();

        // VERIFICA QUE LA CAJA ESTA ABIERTA PARA GENERAL EL INFORME //

        if($cajas->estado == 'abierta'){
            
            $fechaApertura = MovimientoCaja::where('cajas_id','like',$id)
            ->where('descripcion','like' ,'Apertura de Caja')
            ->orderBy('id','DESC')
            ->firstOrFail();
            
            $movimientos = MovimientoCaja::where('cajas_id','like',$id)
            //->whereDate('created_at', '>=',$fechaApertura->created_at)
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia))
            ->where('descripcion','not like' ,'Cierre de Caja')
            ->orderBy('id','DESC')
            ->get();

            $efectivo = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like','Efectivo')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)   
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia))
            ->firstOrFail();

            $cheque = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Cheque')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $transferencia = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Transferencia Bancaria')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $mercado = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Mercado Pago')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $tarjeta = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'tarjeta')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $ahora6 = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Ahora6')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $ahora12 = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Ahora12')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

            $ahora18 = MovimientoCaja::select(DB::raw('sum(entrada) as totalpesos'),DB::raw('sum(saldoparcialdolares) as totaldolares'),DB::raw('sum(salida) as totalSalida'))
            ->where('cajas_id','like',$id)
            ->where('tipo','like' ,'Ahora18')
            //->whereDate('created_at', '>=',$fechaApertura->created_at)  
            ->whereBetween('created_at', array($fechaApertura->created_at,$dia)) 
            ->firstOrFail();

        }
        else{
            return view('cajas.detalleDiarioError', compact('cajas'));
        }

        return view('cajas.detalleDiario', compact('cajas','movimientos','efectivo','cheque','transferencia','mercado','tarjeta','ahora6','ahora12','ahora18'));

    }

    public function resta(Request $request,$id)
    {
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

            $dolar = Dolar::orderBy('id','desc')->firstOrFail();
                        
            $cajas = cajas::find(Auth::user()->caja_id);

            $cajas->saldoPesos = $cajas->saldoPesos - $request->monto;

            $cajas->save();

            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = Auth::user()->caja_id;

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

            
            return back()->with('message','Caja Creada con exito')->with('typealert','success');
                 
        endif;
    }

    public function sumar(Request $request,$id)
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');

        $rules = [

            'descripcion' => 'required',

            'monto' => 'required'
        ];

        $message = [
            
            'descripcion.required' => 'Ingrese La descripcion Del Movimiento',

            'monto.required' => 'Ingrese el Monto Del Movimiento',

        ];

        $validator = Validator::make($request->all(),$rules,$message);


        if( $validator->fails()):

            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert','danger')->withInput();
            
        else:

            $dolar = Dolar::orderBy('id','desc')->firstOrFail();
                        
            $cajas = cajas::find($id);

            $cajas->saldoPesos = $cajas->saldoPesos + $request->monto;

            $cajas->save();

            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = $id;

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
            
            return  back()->with('message','Ingreso Regitrado con exito')->with('typealert','success');
                 
        endif;
    }


    //ABRIR CAJA o Cerrar Cajas//

    public function abrirCerrar(Request $request,$id)
    {

        $mytime = Carbon::now('America/Argentina/Tucuman');
                
        $cajas = cajas::find($id);
        
        if($cajas->estado == 'abierta'): //Cerrar Caja

            $cajas->estado = "cerrada";

            $cajas->saldoPesos = 0;

            $cajas->saldoDolares = 0;

            $cajas->save();

            $dolar = Dolar::orderBy('id','desc')->firstOrFail();
            
            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = $id;

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


        else: //Abrir Caja
            
            if($cajas->id == 1){     //Si es la Caja Principal Carga la Cotizacion del Dolar
            
                $dolar = new Dolar ();
    
                $dolar->valor =  $request->cotizacion;
                
                $dolar->save();

            }

            else{  // Si No obtiene la ultima Cotizacion y la carga

                $dolar = Dolar::orderBy('id','desc')->firstOrFail();

            }
    
            $cajas->estado = "abierta";

            $cajas->saldoDolares = 0;

            $cajas->saldoPesos = $request->ingresoInicial;

            $cajas->save();


            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = $id;

            $movimiento->descripcion = 'Apertura de Caja';

            $movimiento->fecha = $mytime->toDateTimeString();

            $movimiento->entrada = '0';

            $movimiento->salida = '0';

            $movimiento->moneda = 'Pesos';

            $movimiento->tipo = 'Efectivo';

            $movimiento->saldoparcialpesos =  $cajas->saldoPesos;

            $movimiento->saldoparcialdolares =  0;

            $movimiento->cotizacion =  $dolar->valor;

            $movimiento->save();

            $movimiento = new MovimientoCaja();

            $movimiento->cajas_id = $id;

            $movimiento->descripcion = 'Saldo Inicial';

            $movimiento->fecha = $mytime->toDateTimeString();

            $movimiento->entrada = $request->ingresoInicial;

            $movimiento->salida = '0';

            $movimiento->moneda = 'Pesos';

            $movimiento->tipo = 'Efectivo';

            $movimiento->saldoparcialpesos =  $cajas->saldoPesos;

            $movimiento->saldoparcialdolares =  0;

            $movimiento->cotizacion =  $dolar->valor;

            $movimiento->save();

        endif;

        return redirect()->route('cajas.index');

    }
}
