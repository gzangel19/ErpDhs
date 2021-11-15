<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Maquinaria;
use App\Cliente;
use App\Alquiler;
use App\HistorialMaquinaria;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class MaquinariaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    public function index(Request $request)
    {
        $searchText = $request->searchText;

        $searchCondicion = $request->searchCondicion;

        
        if($searchCondicion && $searchText){
        
            if($searchCondicion == 'razon_Social'){
                
                $maquinarias = Maquinaria::join('clientes','maquinarias.cliente_id','=','clientes.id')
                ->select('maquinarias.id as id','maquinarias.modelo','maquinarias.numeroSerie','maquinarias.cliente_id','maquinarias.estado')
                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                ->orderBy('maquinarias.numeroSerie','desc')
                ->paginate(500);

            }
            else{
            
                $maquinarias = Maquinaria::where('numeroSerie','like','%'.$searchText.'%')->orderBy('id', 'DESC')->paginate(200);       
            
            }
        
        }
        else{
            
            $maquinarias = Maquinaria::orderBy('numeroSerie','desc')->paginate(25);   

        }
  
        return view('maquinarias.index',compact('maquinarias'));
       
       
    }

    public function create($id)
    {
        $clientes = Cliente::orderBy('razon_Social','desc')->get();

        return view('maquinarias.create',compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maquinarias = new Maquinaria();

        $maquinarias->cliente_id = $request->cliente_id;

        $maquinarias->ubicacion = $request->ubicacion;

        $maquinarias->modelo = $request->modelo;

        $maquinarias->numeroSerie = $request->numeroSerie;

        $maquinarias->tipo = $request->tipo;

        $maquinarias->estado = $request->estado;

        $maquinarias->save();

        return redirect()->route('maquinarias.index');
    }

    public function showAlquilarVender($id)
    {   
        $maquinarias = Maquinaria::find($id);
        
        $clientes = Cliente::orderby('razon_Social','desc')->get();
                                
        return view('maquinarias.showAlquiler',compact('maquinarias','clientes'));
    }

    public function storeAlquiler(Request $request)
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');

        $maquinarias = Maquinaria::find($request->maquinaria_id);

        $maquinarias->cliente_id = $request->cliente_id;

        $maquinarias->ubicacion = $request->ubicacion;

        $maquinarias->estado = 'Alquilado';

        $maquinarias->save();



        $alquiler = new Alquiler();

        $alquiler->cliente_id = $request->cliente_id;

        $alquiler->maquinaria_id = $request->maquinaria_id;

        $alquiler->fecha = $mytime->toDateTimeString();

        $alquiler->usuario_id = Auth::user()->id;

        $alquiler->estado = 'Activo';

        $alquiler->save();

        
        $alquiler2 = Alquiler::find($alquiler->id);
        
        $alquiler2->num_alquiler= 'NAL-0'.Auth::user()->caja_id.'-'.date('Y').'-'.$alquiler->id;
        
        $alquiler2->save();

        
        $historial = new HistorialMaquinaria();

        $historial->cliente_id = $request->cliente_id;

        $historial->maquinaria_id = $request->maquinaria_id;

        $historial->alquiler_id = $alquiler->id;

        $historial->descripcion = 'Alquiler de Maquina';

        $historial->ubicacion = $request->ubicacion;

        $historial->fecha = $mytime->toDateTimeString();

        $historial->contadorColor = $request->contadorColor;

        $historial->contadorNegro = $request->contadorNegro;

        $historial->contadorTotal =  $request->contadorColor + $request->contadorNegro;

        $historial->save();


        return redirect()->route('maquinarias.index');
    }

    public function show($id)
    {
        
    }
  
    public function finalizarAlquiler($id)
    {
        $maquinarias = Maquinaria::find($id);

        $alquiler = Alquiler::where('maquinaria_id','like',$id)
                            ->where('cliente_id','=',$maquinarias->cliente_id)
                            ->firstOrFail();

        $historial = HistorialMaquinaria::where('maquinaria_id','=',$id)
                                          ->where('cliente_id','=',$maquinarias->cliente_id)
                                          ->orderBy('fecha','desc')
                                          ->get();

        return view('maquinarias.finalizar',compact('maquinarias','alquiler','historial'));
    }

    public function imprimirDetalleAlquiler($id)
    {
        $alquiler = Alquiler::find($id);

        $historial = HistorialMaquinaria::where('maquinaria_id','=',$alquiler->maquinaria_id)
                                          ->where('cliente_id','=',$alquiler->cliente_id)
                                          ->orderBy('fecha','desc')
                                          ->get();
    
        
        $pdf = PDF::loadView('pdf.imprimirDetalleAlquiler',compact('alquiler','historial'))->setPaper('a4','portrait');
    
        return $pdf->stream();
    }

    public function updateAlquiler(Request $request,$id)
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');

        $alquiler = Alquiler::find($id);
        
        $alquiler->estado = 'Finalizado';
        
        $alquiler->fechaBaja = $mytime->toDateTimeString();
        
        $alquiler->save();


        $maquinarias = Maquinaria::find($alquiler->maquinaria_id);

        $maquinarias->cliente_id = 0;

        $maquinarias->ubicacion = 'En Deposito';

        $maquinarias->estado = 'Libre';

        $maquinarias->save();

        
        $historial = new HistorialMaquinaria();

        $historial->cliente_id = $alquiler->cliente_id;

        $historial->maquinaria_id = $alquiler->maquinaria_id;

        $historial->alquiler_id = $id;

        if($request->descripcion == null){
            $historial->descripcion = 'Alquiler Finalizado';
        }
        else{
            $historial->descripcion = $request->descripcion;
        }
       

        $historial->ubicacion = 'Regreso a Deposito';

        $historial->fecha = $mytime->toDateTimeString();

        $historial->contadorColor = $request->contadorColor;

        $historial->contadorNegro = $request->contadorNegro;

        $historial->contadorTotal =  $request->contadorColor + $request->contadorNegro;

        $historial->save();
        
        return redirect()->route('maquinarias.index')->with('success','Cliente actualizado correctamente');
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
