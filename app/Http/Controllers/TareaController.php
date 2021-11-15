<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tarea;
use App\Tipo_Tarea;
use App\Movimiento_Tarea;
use App\Pedido;
use DB;
use Illuminate\Support\Facades\Auth;


class TareaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::orderBy('apellido', 'ASC')
                        ->select('apellido as apellido','nombre as nombre', 'id as id')
                        ->get();

        $tipostareas = Tipo_Tarea::orderBy('nombre', 'ASC')
                        ->select('nombre as nombre', 'id as id')
                        ->get();

        return view('tareas.create',compact('usuarios', 'tipostareas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarea = new Tarea;
        $tarea->detalle = $request->detalle;
        $tarea->estado = 'pendiente';
        $tarea->prioridad = $request->prioridad;
        $tarea->fecha_inicio = date('Y-m-d H:i:s');
        $tarea->tipo_tarea_id = $request->tipo_tarea_id;
        $tarea->user_id = $request->user_id;
        $tarea->save();

        $movimientotarea = new Movimiento_Tarea;
        $movimientotarea->observaciones = 'Asignada';
        $movimientotarea->fecha_movimiento = date('Y-m-d H:i:s');
        $movimientotarea->tarea_id = $tarea->id;
        $movimientotarea->user_id = $request->user_id;
        $movimientotarea->save();

        return redirect()->route('tareas.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function visor()
    {
        $usuarios = User::orderBy('apellido', 'ASC')->paginate(10);

        $tareas = DB::table('tareas')
                ->join('movimientos_tareas','movimientos_tareas.tarea_id','=','tareas.id')
                ->join('tipos_tareas','tipos_tareas.id','=','tareas.tipo_tarea_id')
                ->where('movimientos_tareas.user_id','=',Auth::user()->id)
                ->where('tareas.estado','like','Pendiente')
                ->orderBy('tareas.prioridad','desc')
                ->orderBy('tareas.fecha_inicio','desc')
                ->select('tareas.id as id','tareas.detalle as detalle','tareas.pedido_id as pedido','tareas.estado as estado','tareas.prioridad as prioridad','tareas.fecha_inicio as fecha_inicio','tipos_tareas.nombre as tipotarea')
                ->distinct()->get();

        

        if($tareas->count() > 0){
            return view('tareas.visor', compact('tareas','usuarios'));
        }
        else{
            return view('tareas.error');
        }
        
    }

    public function movimiento(Request $request)
    {
        $tarea = Tarea::find($request->tarea_id);
        $tarea->prioridad = 'normal';
        $tarea->estado = $request->tipo_tarea_id;
        $tarea->save();

        if($tarea->pedido_id > 0 &&  $tarea->estado == 'finalizada'){
            $pedido = Pedido::find($tarea->pedido_id);
            $pedido->estado = 'Entregado';
            $pedido->save();
        }

        if($tarea->pedido_id > 0 && $request->tipo_tarea_id == 'suspendida'){
            $pedido = Pedido::find($tarea->pedido_id);
            $pedido->estado = 'Preparando';
            $pedido->save();
        }

        return back();
    }

    public function asignar(Request $request)
    {
        $tarea = Tarea::find($request->tareas_id);
        $tarea->prioridad = 'normal';
        $tarea->estado = 'Finalizada';
        $tarea->save();

        $tarea2 = new Tarea;
        if($tarea->pedido_id!=0){
            $tarea2->detalle = 'Repartir Venta Nº:'.$tarea->pedido->num_pedido.', Cliente '.' '. $tarea->pedido->cliente->razon_Social;
            $pedido = Pedido::find($tarea->pedido_id);
            $pedido->estado = 'En Reparto';
            $pedido->save();

        }
        else{
            $tarea2->detalle = 'Repartir Venta';
        }
       
        $tarea2->estado = 'pendiente';
        $tarea2->prioridad = 'urgencia';
        $tarea2->fecha_inicio = date('Y-m-d H:i:s');
        $tarea2->tipo_tarea_id = '2';
        $tarea2->user_id = $request->usuario_id;
        $tarea2->pedido_id = $tarea->pedido_id;
        $tarea2->save();

        $movimientotarea = new Movimiento_Tarea;
        $movimientotarea->observaciones = 'Repartir Venta';
        $movimientotarea->fecha_movimiento = date('Y-m-d H:i:s');
        $movimientotarea->tarea_id = $tarea2->id;
        $movimientotarea->user_id = $request->usuario_id;
        $movimientotarea->save();

        if($tarea->pedido_id!=0){
            
            $pedido = Pedido::find($tarea->pedido_id);
            $pedido->estado = 'En Reparto';
            $pedido->save();

        }

        return back();
    }


    public function global(Request $request)
    {
        $usuarios = User::orderBy('apellido', 'ASC')->paginate(10);

        $searchText = $request->searchText;

        $searchCondicion = $request->searchCondicion;

        if($searchCondicion && $searchText){
            
            if($searchCondicion == 'todos'){
                $tareas = DB::table('tareas')
                ->join('movimientos_tareas','movimientos_tareas.tarea_id','=','tareas.id')
                ->join('tipos_tareas','tipos_tareas.id','=','tareas.tipo_tarea_id')
                ->join('users','users.id','=','movimientos_tareas.user_id')
                //->where('tareas.estado','LIKE', '%'.$searchCondicion.'%')
                ->where('users.id','LikE','%'.$searchText.'%')
                //->where('tareas.estado','=','en_proceso')
                //->orderBy('tareas.prioridad','desc')
                ->orderBy('tareas.fecha_inicio','desc')
                ->select('tareas.id as id','tareas.detalle as detalle','tareas.pedido_id as pedido','tareas.servicio_id as servicio','tareas.estado as estado','tareas.prioridad as prioridad','tareas.fecha_inicio as fecha_inicio','tipos_tareas.nombre as tipotarea','users.nombre as nombre_usuario','users.apellido as apellido_usuario')
                ->distinct()->paginate(20);
            }
            else{
                $tareas = DB::table('tareas')
                ->join('movimientos_tareas','movimientos_tareas.tarea_id','=','tareas.id')
                ->join('tipos_tareas','tipos_tareas.id','=','tareas.tipo_tarea_id')
                ->join('users','users.id','=','movimientos_tareas.user_id')
                ->where('tareas.estado','LIKE', '%'.$searchCondicion.'%')
                ->where('users.id','LikE','%'.$searchText.'%')
                //->orWhere('tareas.estado','=','en_proceso')
                //->orderBy('tareas.prioridad','desc')
                ->orderBy('tareas.fecha_inicio','desc')
                ->select('tareas.id as id','tareas.detalle as detalle','tareas.pedido_id as pedido','tareas.servicio_id as servicio','tareas.estado as estado','tareas.prioridad as prioridad','tareas.fecha_inicio as fecha_inicio','tipos_tareas.nombre as tipotarea','users.nombre as nombre_usuario','users.apellido as apellido_usuario')
                ->distinct()->paginate(20);    
            }

            if($searchText == 'todos'){
                $tareas = DB::table('tareas')
                ->join('movimientos_tareas','movimientos_tareas.tarea_id','=','tareas.id')
                ->join('tipos_tareas','tipos_tareas.id','=','tareas.tipo_tarea_id')
                ->join('users','users.id','=','movimientos_tareas.user_id')
                ->where('tareas.estado','LIKE', '%'.$searchCondicion.'%')
                //->where('users.id','LikE','%'.$searchText.'%')
                //->orWhere('tareas.estado','=','en_proceso')
                //->orderBy('tareas.prioridad','desc')
                ->orderBy('tareas.fecha_inicio','desc')
                ->select('tareas.id as id','tareas.detalle as detalle','tareas.pedido_id as pedido','tareas.servicio_id as servicio','tareas.estado as estado','tareas.prioridad as prioridad','tareas.fecha_inicio as fecha_inicio','tipos_tareas.nombre as tipotarea','users.nombre as nombre_usuario','users.apellido as apellido_usuario')
                ->distinct()->paginate(20);
            }
            else{
                $tareas = DB::table('tareas')
                ->join('movimientos_tareas','movimientos_tareas.tarea_id','=','tareas.id')
                ->join('tipos_tareas','tipos_tareas.id','=','tareas.tipo_tarea_id')
                ->join('users','users.id','=','movimientos_tareas.user_id')
                ->where('tareas.estado','LIKE', '%'.$searchCondicion.'%')
                ->where('users.id','LikE','%'.$searchText.'%')
                ->orWhere('tareas.estado','=','en_proceso')
                //->orderBy('tareas.prioridad','desc')
                ->orderBy('tareas.fecha_inicio','desc')
                ->select('tareas.id as id','tareas.detalle as detalle','tareas.pedido_id as pedido','tareas.servicio_id as servicio','tareas.estado as estado','tareas.prioridad as prioridad','tareas.fecha_inicio as fecha_inicio','tipos_tareas.nombre as tipotarea','users.nombre as nombre_usuario','users.apellido as apellido_usuario')
                ->distinct()->paginate(20);    
            }

        }
        else{
            $tareas = DB::table('tareas')
                    ->join('movimientos_tareas','movimientos_tareas.tarea_id','=','tareas.id')
                    ->join('tipos_tareas','tipos_tareas.id','=','tareas.tipo_tarea_id')
                    ->join('users','users.id','=','movimientos_tareas.user_id')
                    //->where('tareas.estado','LIKE', '%'.$searchCondicion.'%')
                    //->where('users.nombre','LikE','%'.$searchText.'%')
                    ->where('tareas.estado','=','Pendiente')
                    //->orderBy('tareas.prioridad','desc')
                    ->orderBy('tareas.fecha_inicio','desc')
                    ->select('tareas.id as id','tareas.detalle as detalle','tareas.estado as estado','tareas.pedido_id as pedido','tareas.servicio_id as servicio','tareas.prioridad as prioridad','tareas.fecha_inicio as fecha_inicio','tipos_tareas.nombre as tipotarea','users.nombre as nombre_usuario','users.apellido as apellido_usuario')
                    ->distinct()->paginate(20);
        }
        
        return view('tareas.global', compact('tareas','usuarios'));
    }
}
