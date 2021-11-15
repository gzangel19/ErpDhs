<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\Cliente;
use App\Empresa;
use App\Tarea;
use App\Movimiento_Tarea;
use App\Unidad_Negocio;
use App\Producto;
use App\Dolar;
use App\User;
use App\Producto_en_Servicio;
use App\Provincia;
use App\Maquinaria;
use App\HistorialMaquinaria;
use App\Producto_Servicio;

use Validator,Hash,Auth,Str,Config,Image;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class ServiciosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index()
    {
        $servicios = Servicio::orderBy('id', 'DESC')->paginate(10);
        return view('servicios.index', compact('servicios'));
    }

    public function search(Request $request){

        $vendedores = User::orderBy('apellido', 'DESC')->where('estado','activo')->get();

        $searchText = $request->searchText;

        $searchCondicion = $request->searchCondicion;

        $tecnico = $request->tecnico;

        $status = $request->status;

        $statusPago = $request->statusPago;

        //return $request;

        switch ($searchCondicion):

            case 'razon_Social':

                                switch($searchText):

                                    case null:

                                        switch($tecnico):

                                                            case 'Todos':

                                                                        switch($status):

                                                                                        case 'Todos':
                                                                                                    
                                                                                                        switch($statusPago):

                                                                                                                            case 'Todos':
                                                                          
                                                                                                                                $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                                            break;

                                                                                                                            case 'Impago':

                                                                                                                                $servicios = Servicio::with(['cliente','maquina'])                          
                                                                                                                                ->where('pago','Impago')
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                                            break;

                                                                                                                            case 'Pagado':

                                                                                                                                $servicios = Servicio::with(['cliente','maquina'])                                                                 
                                                                                                                                ->where('pago','Pagado')
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                                            break;


                                                                                                        endswitch;
                                                                                                        
                                                                                        break;

                                                                                        case 'Reparacion':

                                                                                                        switch($statusPago):

                                                                                                            case 'Todos':
                                                                                                                
                                                                                                                $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                ->where('estado','Reparacion')
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);
        
                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                            break;

                                                                                                            case 'Impago':

                                                                                                                $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                ->where('estado','Reparacion')                                                                          
                                                                                                                ->where('pago','Impago')
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);
        
                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                            break;

                                                                                                            case 'Pagado':

                                                                                                                $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                ->where('estado','Reparacion')                                                                         
                                                                                                                ->where('pago','Pagado')
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);
        
                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                            break;


                                                                                                        endswitch;
                                                                                                        

                                                                                        break;

                                                                                        case 'Finalizado':

                                                                                                            switch($statusPago):

                                                                                                                case 'Todos':

                                                                                                                    $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                    ->where('estado','Finalizado')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('servicios.search', compact('servicios'));

                                                                                                                break;

                                                                                                                case 'Impago':

                                                                                                                    $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                    ->where('estado','Finalizado')                                                                          
                                                                                                                    ->where('pago','Impago')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('servicios.search', compact('servicios'));

                                                                                                                break;

                                                                                                                case 'Pagado':

                                                                                                                    $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                    ->where('estado','Finalizado')                                                                         
                                                                                                                    ->where('pago','Pagado')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('servicios.search', compact('servicios'));

                                                                                                                break;


                                                                                                            endswitch;

                                                                                        break;

                                                                                        case 'Cancelado':
                                                                                            
                                                                                            $servicios = Servicio::with(['cliente','maquina'])
                                                                                                        ->where('estado','Cancelado')                                                                                           
                                                                                                        ->orderBy('id', 'desc')
                                                                                                        ->paginate(500);

                                                                                            return view('servicios.search', compact('servicios'));

                                                                                        break;


                                                                        endswitch;
                                                            break;

                                                            default:

                                                                    switch($status):

                                                                                        case 'Todos':
                                                                                                    
                                                                                                        switch($statusPago):

                                                                                                                            case 'Todos':

                                                                                                                                $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                                ->where('tecnico','like','%'.$tecnico.'%')                                                                                                                           
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                                            break;

                                                                                                                            case 'Impago':

                                                                                                                                $servicios = Servicio::with(['cliente','maquina'])  
                                                                                                                                ->where('tecnico','like','%'.$tecnico.'%')                                                                       
                                                                                                                                ->where('pago','Impago')
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                                            break;

                                                                                                                            case 'Pagado':

                                                                                                                                $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                                ->where('tecnico','like','%'.$tecnico.'%')                                                                      
                                                                                                                                ->where('pago','Pagado')
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                                            break;


                                                                                                        endswitch;
                                                                                                        
                                                                                        break;

                                                                                        case 'Reparacion':

                                                                                                        switch($statusPago):

                                                                                                            case 'Todos':

                                                                                                                $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                ->where('tecnico','like','%'.$tecnico.'%')  
                                                                                                                ->where('estado','Reparacion')                                                                                                                        
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);

                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                            break;

                                                                                                            case 'Impago':

                                                                                                                $servicios = Servicio::with(['cliente','maquina']) 
                                                                                                                ->where('tecnico','like','%'.$tecnico.'%')  
                                                                                                                ->where('estado','Reparacion')                                                                       
                                                                                                                ->where('pago','Impago')
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);

                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                            break;

                                                                                                            case 'Pagado':

                                                                                                                $servicios = Servicio::with(['cliente','maquina']) 
                                                                                                                ->where('tecnico','like','%'.$tecnico.'%')  
                                                                                                                ->where('estado','Reparacion')                                                                      
                                                                                                                ->where('pago','Pagado')
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);

                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                            break;


                                                                                                        endswitch;

                                                                                        break;

                                                                                        case 'Finalizado':

                                                                                                            switch($statusPago):

                                                                                                                case 'Todos':

                                                                                                                    $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                    ->where('tecnico','like','%'.$tecnico.'%')  
                                                                                                                    ->where('estado','Finalizado')                                                                                                                        
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('servicios.search', compact('servicios'));

                                                                                                                break;

                                                                                                                case 'Impago':

                                                                                                                    $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                    ->where('tecnico','like','%'.$tecnico.'%') 
                                                                                                                    ->where('estado','Finalizado')                                                                       
                                                                                                                    ->where('pago','Impago')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('servicios.search', compact('servicios'));

                                                                                                                break;

                                                                                                                case 'Pagado':

                                                                                                                    $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                    ->where('tecnico','like','%'.$tecnico.'%')  
                                                                                                                    ->where('estado','Finalizado')                                                                      
                                                                                                                    ->where('pago','Pagado')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('servicios.search', compact('servicios'));

                                                                                                                break;


                                                                                                            endswitch;

                                                                                        break;

                                                                                        case 'Cancelado':
                                                                                            
                                                                                                                    $servicios = Servicio::with(['cliente','maquina'])
                                                                                                                    ->where('tecnico','like','%'.$tecnico.'%')  
                                                                                                                    ->where('estado','Cancelado')                                                                      
                                                                                                                    ->where('pago','Cancelado')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('servicios.search', compact('servicios'));

                                                                                        break;


                                                                    endswitch;                    

                                                                    

                                                            break;

                                        endswitch;
                                    
                                    default:

                                            switch($status):
                                                            case 'Todos':

                                                                            switch($statusPago):

                                                                                                case 'Todos':

                                                                                                            $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                            ->select('servicios.codigo',
                                                                                                                    'servicios.cliente_id',
                                                                                                                    'servicios.equipo_id',
                                                                                                                    'servicios.tecnico',
                                                                                                                    'servicios.estado',
                                                                                                                    'servicios.pago',
                                                                                                                    'servicios.id as id')
                                                                                                            ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                            ->orderBy('servicios.id','desc')
                                                                                                            ->paginate(500);
                                
                                                                                                            return view('servicios.search', compact('servicios'));

                                                                                                break;

                                                                                                case 'Impago':

                                                                                                                        $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                                        ->select('servicios.codigo',
                                                                                                                                'servicios.cliente_id',
                                                                                                                                'servicios.equipo_id',
                                                                                                                                'servicios.tecnico',
                                                                                                                                'servicios.estado',
                                                                                                                                'servicios.pago',
                                                                                                                                'servicios.id as id')
                                                                                                                        ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                        ->where('servicios.pago','Impago')
                                                                                                                        ->orderBy('servicios.id','desc')
                                                                                                                        ->paginate(500);

                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                break;

                                                                                                case 'Pagado':

                                                                                                                        $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                                        ->select('servicios.codigo',
                                                                                                                                'servicios.cliente_id',
                                                                                                                                'servicios.equipo_id',
                                                                                                                                'servicios.tecnico',
                                                                                                                                'servicios.estado',
                                                                                                                                'servicios.pago',
                                                                                                                                'servicios.id as id')
                                                                                                                        ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                        ->where('servicios.pago','Pagado')
                                                                                                                        ->orderBy('servicios.id','desc')
                                                                                                                        ->paginate(500);
                                                                                                                    
                                                                                                                return view('servicios.search', compact('servicios'));
                                                                                                break;

                                                                            endswitch;    

                                                            break;

                                                            case 'Reparacion':
                                                                            
                                                                                switch($statusPago):

                                                                                                    case 'Todos':

                                                                                                            $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                                ->select('servicios.codigo',
                                                                                                                'servicios.cliente_id',
                                                                                                                'servicios.equipo_id',
                                                                                                                'servicios.tecnico',
                                                                                                                'servicios.estado',
                                                                                                                'servicios.pago',
                                                                                                                'servicios.id as id')
                                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                ->where('servicios.estado','Reparacion')
                                                                                                                ->orderBy('servicios.id','desc')
                                                                                                                ->paginate(500);
                                    
                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));
                            
                                                                                                    break;

                                                                                                    case 'Pagado':

                                                                                                                            $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                                                ->select('servicios.codigo',
                                                                                                                                'servicios.cliente_id',
                                                                                                                                'servicios.equipo_id',
                                                                                                                                'servicios.tecnico',
                                                                                                                                'servicios.estado',
                                                                                                                                'servicios.pago',
                                                                                                                                'servicios.id as id')
                                                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                                ->where('servicios.estado','Reparacion')
                                                                                                                                ->where('servicios.pago','Pagado')
                                                                                                                                ->orderBy('servicios.id','desc')
                                                                                                                                ->paginate(500);
                                                    
                                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                                    break;

                                                                                                    case 'Impago':

                                                                                                                    $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                                            ->select('servicios.codigo',
                                                                                                                            'servicios.cliente_id',
                                                                                                                            'servicios.equipo_id',
                                                                                                                            'servicios.tecnico',
                                                                                                                            'servicios.estado',
                                                                                                                            'servicios.pago',
                                                                                                                            'servicios.id as id')
                                                                                                                            ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                            ->where('servicios.estado','Reparacion')
                                                                                                                            ->where('servicios.pago','Impago')
                                                                                                                            ->orderBy('servicios.id','desc')
                                                                                                                            ->paginate(500);
                                    
                                                                                                                    return view('servicios.search', compact('servicios'));

                                                                                                    break;
                                                                                endswitch;

                                                            break;

                                                            case 'Finalizado':
                                                                                switch($statusPago):

                                                                                    case 'Todos':

                                                                                            $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                ->select('servicios.codigo',
                                                                                                    'servicios.cliente_id',
                                                                                                    'servicios.equipo_id',
                                                                                                    'servicios.tecnico',
                                                                                                    'servicios.estado',
                                                                                                    'servicios.pago',
                                                                                                    'servicios.id as id')
                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                ->where('servicios.estado','Finalizado')
                                                                                                ->orderBy('servicios.id','desc')
                                                                                                ->paginate(500);
                    
                                                                                                return view('servicios.search', compact('servicios'));

                                                                                    break;

                                                                                    case 'Pagado':

                                                                                                    $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                            ->select('servicios.codigo',
                                                                                                                'servicios.cliente_id',
                                                                                                                'servicios.equipo_id',
                                                                                                                'servicios.tecnico',
                                                                                                                'servicios.estado',
                                                                                                                'servicios.pago',
                                                                                                                'servicios.id as id')
                                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                ->where('servicios.estado','Finalizado')
                                                                                                                ->where('servicios.pago','Pagado')
                                                                                                                ->orderBy('servicios.id','desc')
                                                                                                                ->paginate(500);
                                    
                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                    break;

                                                                                    case 'Impago':

                                                                                                        $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                            ->select('servicios.codigo',
                                                                                                                'servicios.cliente_id',
                                                                                                                'servicios.equipo_id',
                                                                                                                'servicios.tecnico',
                                                                                                                'servicios.estado',
                                                                                                                'servicios.pago',
                                                                                                                'servicios.id as id')
                                                                                                            ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                            ->where('servicios.estado','Finalizado')
                                                                                                            ->where('servicios.pago','Impago')
                                                                                                            ->orderBy('servicios.id','desc')
                                                                                                            ->paginate(500);
                    
                                                                                                    return view('servicios.search', compact('pedidos'));

                                                                                    break;
                                                                                
                                                                                endswitch;

                                                            break;

                                                            case 'Cancelado':
                                                                                switch($statusPago):

                                                                                    case 'Todos':

                                                                                            $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                ->select('servicios.codigo',
                                                                                                    'servicios.cliente_id',
                                                                                                    'servicios.equipo_id',
                                                                                                    'servicios.tecnico',
                                                                                                    'servicios.estado',
                                                                                                    'servicios.pago',
                                                                                                    'servicios.id as id')
                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                ->where('servicios.estado','Cancelado')
                                                                                                ->orderBy('servicios.id','desc')
                                                                                                ->paginate(500);
                    
                                                                                                return view('servicios.search', compact('servicios'));

                                                                                    break;

                                                                                    case 'Pagado':

                                                                                                        $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                                                ->select('servicios.codigo',
                                                                                                                                    'servicios.cliente_id',
                                                                                                                                    'servicios.equipo_id',
                                                                                                                                    'servicios.tecnico',
                                                                                                                                    'servicios.estado',
                                                                                                                                    'servicios.pago',
                                                                                                                                    'servicios.id as id')
                                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                ->where('servicios.estado','Cancelado')
                                                                                                                ->where('servicios.pago','Pagado')
                                                                                                                ->orderBy('servicios.id','desc')
                                                                                                                ->paginate(500);
                                    
                                                                                                                return view('servicios.search', compact('servicios'));

                                                                                    break;

                                                                                    case 'Impago':

                                                                                                    $servicios = Servicio::join('clientes','servicios.cliente_id','=','clientes.id')
                                                                                                        ->select('servicios.codigo',
                                                                                                            'servicios.cliente_id',
                                                                                                            'servicios.equipo_id',
                                                                                                            'servicios.tecnico',
                                                                                                            'servicios.estado',
                                                                                                            'servicios.pago',
                                                                                                            'servicios.id as id')
                                                                                                            ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                            ->where('servicios.estado','Cancelado')
                                                                                                            ->where('servicios.pago','Impago')
                                                                                                            ->orderBy('servicios.id','desc')
                                                                                                            ->paginate(500);
                    
                                                                                                    return view('servicios.search', compact('servicios'));

                                                                                    break;
                                                                                
                                                                                endswitch;

                                                            break;

                                            endswitch;

                                endswitch; 

                break;

            case 'codigo':

                                $servicios = Servicio::where('codigo','like','%'.$searchText.'%')->paginate(200);       
                            
                                return view('servicios.search', compact('servicios','vendedores'));

                                break;
            
            default:

                            $servicios = Servicio::with(['cliente','maquina'])
                                ->where('estado','not like','Cancelado')
                                ->where('estado','not like','Entregado')
                                ->orWhere('pago','not like', 'Pagado')
                                ->where('pago','not like','Cancelado')
                                ->orderBy('id', 'desc')
                                ->paginate(20);

                    return view('servicios.search', compact('servicios'));
        endswitch; 

    
    }
    
    public function clientes(Request $request)
    {
        
        $searchText = $request->searchText;

        $searchCondicion = $request->searchCondicion;

        if($searchCondicion && $searchText){
            
            $clientes = Cliente::where($searchCondicion,'like','%'.$searchText.'%')->orderBy('id', 'DESC')->paginate(200);

        }
        else{
            $clientes = Cliente::orderBy('id', 'DESC')->paginate(25);
        }
        
        $provincias = Provincia::orderBy('nombre', 'ASC')
        ->select('nombre as nombre', 'id as id')
        ->get();

        return view('servicios.seleccionarCliente',["clientes"=>$clientes,"provincias"=>$provincias]);

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
        $cliente->facturacion = 'Si';
        $cliente->rubro_id = 1;
        $cliente->save();

        $cliente2 = Cliente::find($cliente->id);
        $cliente2->num_cliente = 'NCT-'.$cliente->id;
        $cliente2->save();

        return redirect()->route('servicios.equipos',$cliente->id);
    }

    public function equipos($id)
    {
        
        $cliente = Cliente::find($id);

        $equipos = Maquinaria::where('cliente_id','=',$id)->paginate(25);

        return view('servicios.seleccionarEquipos',["cliente"=>$cliente,"equipos"=>$equipos]);

    }

    public function maquinarias(Request $request)
    {
        
        $cliente = Cliente::find($request->cliente_id);

        $equipo = new Maquinaria();

        $equipo->cliente_id = $cliente->id;

        $equipo->ubicacion =  $request->ubicacion;

        $equipo->modelo = $request->modelo;

        $equipo->condicion = $request->condicion;

        $equipo->numeroSerie = $request->numeroSerie;

        $equipo->tipo = $request->tipo;

        $equipo->estado = 'Libre';

        $equipo->save();

        return back();

    }

    public function create($cliente_id,$maquinaria_id){

        $cliente = Cliente::find($cliente_id);

        $equipo = Maquinaria::find($maquinaria_id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $productos = Producto::where('unidadnegocio_id',6)->where('nombre','like','%'.'Servicio'.'%')->get();

        $data = ["cliente"=>$cliente,"equipo"=>$equipo,"productos"=>$productos,"dolar"=>$dolar] ;

       // $productos = Producto::where('unidadnegocio_id','=',5)->get();

        return view('servicios.create',$data);

    }

    public function store(Request $request)
    {

        $rulesValidation = [
            'falla' => 'required'
        ];

        $messages = [
            'falla.required' => 'Ingrese La Posible Falla'
        ];

        $validator = Validator::make($request->all(),$rulesValidation,$messages);

        if($validator->fails()):
        
            return back()->withErrors($validator)->with('message','Se ha producido un error','typealert','danger')->withInput();
        
        else:

            $mytime = Carbon::now('America/Argentina/Tucuman');

            $servicio = new Servicio();
            $servicio->cliente_id = $request->cliente_id;
            $servicio->equipo_id = $request->equipo_id;
            $servicio->costoRevision = $request->costoRevision;
            $servicio->falla = $request->falla;
            

            if( $servicio->save()):

                $this->agregarNumeroServicio($servicio->id);

                $this->crearTarea($servicio);    

                $historialMaquinaria = new HistorialMaquinaria();
                $historialMaquinaria->maquinaria_id = $request->equipo_id;
                $historialMaquinaria->cliente_id = $request->cliente_id;
                $historialMaquinaria->servicio_id = $servicio->id;
                $historialMaquinaria->descripcion = "Registro Servicio Tecnico";
                $historialMaquinaria->fecha = $mytime->toDateTimeString();
                $historialMaquinaria->save();

                return redirect()->route('servicios.index')->with('success','servicios agregado correctamente');

            endif;

        endif;

        

       
       
    }

    private function crearTarea(Servicio $servicio){

        $tarea = new Tarea();
        $tarea->detalle = 'Recepcion de Equipo, Cliente:'.$servicio->cliente->razon_Social;
        $tarea->estado = 'pendiente';
        $tarea->prioridad = 'urgencia';
        $tarea->fecha_inicio = date('Y-m-d H:i:s');
        $tarea->tipo_tarea_id = '1';
        $tarea->user_id = '5';
        $tarea->servicio_id = $servicio->id;
        $tarea->save();
    
        $movimientotarea = new Movimiento_Tarea();
        $movimientotarea->observaciones = 'Recepcion de Equipo';
        $movimientotarea->fecha_movimiento = date('Y-m-d H:i:s');
        $movimientotarea->tarea_id = $tarea->id;
        $movimientotarea->user_id = '5';
        $movimientotarea->save();
    }

    private function agregarNumeroServicio($servicio_id){
        
        $servicio = Servicio::find($servicio_id);
        
        $servicio->codigo = 'NST-0'.Auth::user()->caja_id.'-'.date('Y').'-'.$servicio_id;
        
        $servicio->save();
    }

    public function show($id)
    {
        $servicio = Servicio::find($id);

        $productos = Producto::get();

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $productoServicio= Producto_Servicio::where('servicio_id',$id)->get();

        $data = ["servicio"=>$servicio,"productos"=>$productos,"dolar"=>$dolar,'productoServicio'=>$productoServicio] ;

        return view('servicios.show',$data);
    }

    public function cotizar($id)
    {
        $servicio = Servicio::find($id);

        return view('servicios.cotizar', compact('servicio'));
    }


    public function update(Request $request, $id)
    {

        $servicio = Servicio::find($id);
        $servicio->costoTrabajo = $request->costoTrabajo;
        $servicio->tareaRealizada	 = $request->tareaRealizada;
        $servicio->tecnico	 = $request->tecnico;
        $servicio->contadorColor	 = $request->contadorColor;
        $servicio->contadorNegro	 = $request->contadorNegro;
        $servicio->contadorTotal	 = $request->contadorTotal;
        $servicio->estado = 'Finalizado';
        $servicio->save();

        return redirect()->route('servicios.index')->with('success','servicio actualizado correctamente');
    }

    public function delete($id)
    {

        $servicio = Servicio::find($id);
        
        $servicio->estado = 'Cancelado';
        
        $servicio->save();

        return back()->with('message','Servicio Tecnico Cancelado','typealert','success');
    }

    
    public function comprobante($id)
    {
        $servicio = Servicio::find($id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $image =  \QrCode::size(100)->generate('https://web.facebook.com/dhstienda');
        
        $pdf = PDF::loadView('servicios.comprobante',compact('image','servicio','dolar'))->setPaper('a4','portrait');
    
        return $pdf->stream();
    }

    public function comprobanteRetiro($id)
    {
        $servicio = Servicio::find($id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $image =  \QrCode::size(100)->generate('https://web.facebook.com/dhstienda');
        
        $pdf = PDF::loadView('servicios.comprobanteRetiro',compact('image','servicio'))->setPaper('a4','portrait');
    
        return $pdf->stream();
    }

    
    public function cargarProductoServicio($producto_id,$servicio_id){ 

        $producto_Servicio = new Producto_Servicio();
        $producto_Servicio->servicio_id = $servicio_id;
        $producto_Servicio->producto_id = $producto_id;
        $producto_Servicio->user_id = Auth::user()->id;
        $producto_Servicio->cantidad = "1";
        $producto_Servicio->save();

        return back();

    }


}
