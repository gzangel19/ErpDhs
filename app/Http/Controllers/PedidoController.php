<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Cliente;
use App\Tarea;
use App\Provincia;
use App\Movimiento_Tarea;
use App\Cajas;
use App\MovimientoCaja;
use App\Producto;
use App\Pagos_Cuenta;
use App\Pagos;
use App\Detalle_Pedido;
use App\Deposito;
use App\Dolar;
use App\Unidad_Negocio;
use App\User;
use App\DepositoProducto;
use App\MovimientoDeposito;
use DB;
use Carbon\Carbon;
use Response;
use App\HistorialMovimientos;
use Illuminate\Support\Collection;
use Luecano\NumeroALetras\NumeroALetras;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Log;
use App\Exports\PedidosExport;
use Maatwebsite\Excel\Facades\Excel;

class PedidoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index(Request $request){

        $vendedores = User::orderBy('apellido', 'DESC')->where('estado','activo')->get();

        $pedidos = Pedido::with(['user','deposito','cliente'])
                                ->where('estado','not like','Cancelado')
                                ->where('estado','not like','Entregado')
                                ->orWhere('pago','not like', 'Pagado')
                                ->where('pago','not like','Cancelado')
                                ->orderBy('id', 'desc')
                                ->paginate(20);
            

        return view('pedidos.index', compact('pedidos','vendedores'));
  
    }

    public function search(Request $request){

        $vendedores = User::orderBy('apellido', 'DESC')->where('estado','activo')->get();

        $searchText = $request->searchText;

        $searchCondicion = $request->searchCondicion;

        $vendedor = $request->vendedor;

        $status = $request->status;

        $statusPago = $request->statusPago;

        switch ($searchCondicion):

            case 'razon_Social':

                                switch($searchText):

                                    case null:

                                        switch($vendedor):

                                                            case 'Todos':

                                                                        switch($status):

                                                                                        case 'Todos':
                                                                                                    
                                                                                                        switch($statusPago):

                                                                                                                            case 'Todos':

                                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente'])
                                                                                                                                ->where('estado','not like','Cancelado')
                                                                                                                                ->where('estado','not like','Entregado')
                                                                                                                                ->orWhere('pago','not like', 'Pagado')
                                                                                                                                ->where('pago','not like','Cancelado')
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                            break;

                                                                                                                            case 'Impago':

                                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente'])                                                                          
                                                                                                                                ->where('pago','Impago')
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                            break;

                                                                                                                            case 'Pagado':

                                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente'])                                                                          
                                                                                                                                ->where('pago','Pagado')
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                            break;


                                                                                                        endswitch;
                                                                                                        
                                                                                        break;

                                                                                        case 'Entregado':

                                                                                                        switch($statusPago):

                                                                                                            case 'Todos':

                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente'])
                                                                                                                ->where('estado','Entregado')
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);
        
                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                            break;

                                                                                                            case 'Impago':

                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente'])
                                                                                                                ->where('estado','Entregado')                                                                          
                                                                                                                ->where('pago','Impago')
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);
        
                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                            break;

                                                                                                            case 'Pagado':

                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente']) 
                                                                                                                ->where('estado','Entregado')                                                                         
                                                                                                                ->where('pago','Pagado')
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);
        
                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                            break;


                                                                                                        endswitch;
                                                                                                        

                                                                                        break;

                                                                                        case 'Preparando':

                                                                                                            switch($statusPago):

                                                                                                                case 'Todos':

                                                                                                                    $pedidos = Pedido::with(['user','deposito','cliente'])
                                                                                                                    ->where('estado','Preparando')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                break;

                                                                                                                case 'Impago':

                                                                                                                    $pedidos = Pedido::with(['user','deposito','cliente'])
                                                                                                                    ->where('estado','Preparando')                                                                          
                                                                                                                    ->where('pago','Impago')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                break;

                                                                                                                case 'Pagado':

                                                                                                                    $pedidos = Pedido::with(['user','deposito','cliente']) 
                                                                                                                    ->where('estado','Preparando')                                                                         
                                                                                                                    ->where('pago','Pagado')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                break;


                                                                                                            endswitch;

                                                                                        break;

                                                                                        case 'Cancelado':
                                                                                            
                                                                                        $pedidos = Pedido::with(['user','deposito','cliente']) 
                                                                                                    ->where('estado','Cancelado')                                                                      
                                                                                                    ->where('pago','Pagado')
                                                                                                    ->orderBy('id', 'desc')
                                                                                                    ->paginate(500);

                                                                                        return view('pedidos.search', compact('pedidos','vendedores'));

                                                                        break;


                                                                        endswitch;
                                                            break;

                                                            default:

                                                                    switch($status):

                                                                                        case 'Todos':
                                                                                                    
                                                                                                        switch($statusPago):

                                                                                                                            case 'Todos':

                                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente'])
                                                                                                                                ->where('usuario_id',$vendedor)                                                                                                                           
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                            break;

                                                                                                                            case 'Impago':

                                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente'])  
                                                                                                                                ->where('usuario_id',$vendedor)                                                                        
                                                                                                                                ->where('pago','Impago')
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                            break;

                                                                                                                            case 'Pagado':

                                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente']) 
                                                                                                                                ->where('usuario_id',$vendedor)                                                                        
                                                                                                                                ->where('pago','Pagado')
                                                                                                                                ->orderBy('id', 'desc')
                                                                                                                                ->paginate(500);
                        
                                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                            break;


                                                                                                        endswitch;
                                                                                                        
                                                                                        break;

                                                                                        case 'Entregado':

                                                                                                        switch($statusPago):

                                                                                                            case 'Todos':

                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente'])
                                                                                                                ->where('usuario_id',$vendedor)  
                                                                                                                ->where('estado','Entregado')                                                                                                                        
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);

                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                            break;

                                                                                                            case 'Impago':

                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente'])  
                                                                                                                ->where('usuario_id',$vendedor) 
                                                                                                                ->where('estado','Entregado')                                                                       
                                                                                                                ->where('pago','Impago')
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);

                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                            break;

                                                                                                            case 'Pagado':

                                                                                                                $pedidos = Pedido::with(['user','deposito','cliente']) 
                                                                                                                ->where('usuario_id',$vendedor)  
                                                                                                                ->where('estado','Entregado')                                                                      
                                                                                                                ->where('pago','Pagado')
                                                                                                                ->orderBy('id', 'desc')
                                                                                                                ->paginate(500);

                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                            break;


                                                                                                        endswitch;

                                                                                        break;

                                                                                        case 'Preparando':

                                                                                                            switch($statusPago):

                                                                                                                case 'Todos':

                                                                                                                    $pedidos = Pedido::with(['user','deposito','cliente'])
                                                                                                                    ->where('usuario_id',$vendedor)  
                                                                                                                    ->where('estado','Preparando')                                                                                                                        
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                break;

                                                                                                                case 'Impago':

                                                                                                                    $pedidos = Pedido::with(['user','deposito','cliente'])  
                                                                                                                    ->where('usuario_id',$vendedor) 
                                                                                                                    ->where('estado','Preparando')                                                                       
                                                                                                                    ->where('pago','Impago')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                break;

                                                                                                                case 'Pagado':

                                                                                                                    $pedidos = Pedido::with(['user','deposito','cliente']) 
                                                                                                                    ->where('usuario_id',$vendedor)  
                                                                                                                    ->where('estado','Preparando')                                                                      
                                                                                                                    ->where('pago','Pagado')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                                    return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                                break;


                                                                                                            endswitch;

                                                                                        break;

                                                                                        case 'Cancelado':
                                                                                            
                                                                                                            $pedidos = Pedido::with(['user','deposito','cliente']) 
                                                                                                                    ->where('usuario_id',$vendedor)  
                                                                                                                    ->where('estado','Cancelado')                                                                      
                                                                                                                    ->where('pago','Pagado')
                                                                                                                    ->orderBy('id', 'desc')
                                                                                                                    ->paginate(500);

                                                                                                            return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                        break;


                                                                        endswitch;                    

                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                            break;

                                        endswitch;
                                    
                                    default:

                                            switch($status):
                                                            case 'Todos':

                                                                            switch($statusPago):

                                                                                                case 'Todos':

                                                                                                            $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                            ->select('pedidos.num_pedido',
                                                                                                                    'pedidos.fecha',
                                                                                                                    'pedidos.cliente_id',
                                                                                                                    'pedidos.usuario_id',
                                                                                                                    'pedidos.estado',
                                                                                                                    'pedidos.pago',
                                                                                                                    'pedidos.id as id',
                                                                                                                    'pedidos.total',
                                                                                                                    'pedidos.deposito_id')
                                                                                                            ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                            ->orderBy('pedidos.id','desc')
                                                                                                            ->paginate(500);
                                
                                                                                                            return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                break;

                                                                                                case 'Impago':

                                                                                                                $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                                        ->select('pedidos.num_pedido',
                                                                                                                                'pedidos.fecha',
                                                                                                                                'pedidos.cliente_id',
                                                                                                                                'pedidos.usuario_id',
                                                                                                                                'pedidos.estado',
                                                                                                                                'pedidos.pago',
                                                                                                                                'pedidos.id as id',
                                                                                                                                'pedidos.total',
                                                                                                                                'pedidos.deposito_id')
                                                                                                                        ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                        ->where('pedidos.pago','Impago')
                                                                                                                        ->orderBy('pedidos.id','desc')
                                                                                                                        ->paginate(500);

                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                break;

                                                                                                case 'Pagado':

                                                                                                                $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                                        ->select('pedidos.num_pedido',
                                                                                                                                'pedidos.fecha',
                                                                                                                                'pedidos.cliente_id',
                                                                                                                                'pedidos.usuario_id',
                                                                                                                                'pedidos.estado',
                                                                                                                                'pedidos.pago',
                                                                                                                                'pedidos.id as id',
                                                                                                                                'pedidos.total',
                                                                                                                                'pedidos.deposito_id')
                                                                                                                        ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                        ->where('pedidos.pago','Pagado')
                                                                                                                        ->orderBy('pedidos.id','desc')
                                                                                                                        ->paginate(500);
                                                                                                                    
                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));
                                                                                                break;

                                                                            endswitch;    

                                                            break;

                                                            case 'Entregado':
                                                                            
                                                                                switch($statusPago):

                                                                                                    case 'Todos':

                                                                                                                $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                                ->select('pedidos.num_pedido',
                                                                                                                        'pedidos.fecha',
                                                                                                                        'pedidos.cliente_id',
                                                                                                                        'pedidos.usuario_id',
                                                                                                                        'pedidos.estado',
                                                                                                                        'pedidos.pago',
                                                                                                                        'pedidos.id as id',
                                                                                                                        'pedidos.total',
                                                                                                                        'pedidos.deposito_id')
                                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                ->where('estado','Entregado')
                                                                                                                ->orderBy('pedidos.id','desc')
                                                                                                                ->paginate(500);
                                    
                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));
                            
                                                                                                    break;

                                                                                                    case 'Pagado':

                                                                                                                    $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                                                ->select('pedidos.num_pedido',
                                                                                                                                        'pedidos.fecha',
                                                                                                                                        'pedidos.cliente_id',
                                                                                                                                        'pedidos.usuario_id',
                                                                                                                                        'pedidos.estado',
                                                                                                                                        'pedidos.pago',
                                                                                                                                        'pedidos.id as id',
                                                                                                                                        'pedidos.total',
                                                                                                                                        'pedidos.deposito_id')
                                                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                                ->where('estado','Entregado')
                                                                                                                                ->where('pago','Pagado')
                                                                                                                                ->orderBy('pedidos.id','desc')
                                                                                                                                ->paginate(500);
                                                    
                                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                    break;

                                                                                                    case 'Impago':

                                                                                                                    $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                                            ->select('pedidos.num_pedido',
                                                                                                                                    'pedidos.fecha',
                                                                                                                                    'pedidos.cliente_id',
                                                                                                                                    'pedidos.usuario_id',
                                                                                                                                    'pedidos.estado',
                                                                                                                                    'pedidos.pago',
                                                                                                                                    'pedidos.id as id',
                                                                                                                                    'pedidos.total',
                                                                                                                                    'pedidos.deposito_id')
                                                                                                                            ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                            ->where('estado','Entregado')
                                                                                                                            ->where('pago','Impago')
                                                                                                                            ->orderBy('pedidos.id','desc')
                                                                                                                            ->paginate(500);
                                    
                                                                                                                    return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                                    break;
                                                                                endswitch;

                                                            break;

                                                            case 'Preparando':
                                                                                switch($statusPago):

                                                                                    case 'Todos':

                                                                                                $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                ->select('pedidos.num_pedido',
                                                                                                        'pedidos.fecha',
                                                                                                        'pedidos.cliente_id',
                                                                                                        'pedidos.usuario_id',
                                                                                                        'pedidos.estado',
                                                                                                        'pedidos.pago',
                                                                                                        'pedidos.id as id',
                                                                                                        'pedidos.total',
                                                                                                        'pedidos.deposito_id')
                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                ->where('estado','Preparando')
                                                                                                ->orderBy('pedidos.id','desc')
                                                                                                ->paginate(500);
                    
                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                    break;

                                                                                    case 'Pagado':

                                                                                                    $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                                ->select('pedidos.num_pedido',
                                                                                                                        'pedidos.fecha',
                                                                                                                        'pedidos.cliente_id',
                                                                                                                        'pedidos.usuario_id',
                                                                                                                        'pedidos.estado',
                                                                                                                        'pedidos.pago',
                                                                                                                        'pedidos.id as id',
                                                                                                                        'pedidos.total',
                                                                                                                        'pedidos.deposito_id')
                                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                ->where('estado','Preparando')
                                                                                                                ->where('pago','Pagado')
                                                                                                                ->orderBy('pedidos.id','desc')
                                                                                                                ->paginate(500);
                                    
                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                    break;

                                                                                    case 'Impago':

                                                                                                    $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                            ->select('pedidos.num_pedido',
                                                                                                                    'pedidos.fecha',
                                                                                                                    'pedidos.cliente_id',
                                                                                                                    'pedidos.usuario_id',
                                                                                                                    'pedidos.estado',
                                                                                                                    'pedidos.pago',
                                                                                                                    'pedidos.id as id',
                                                                                                                    'pedidos.total',
                                                                                                                    'pedidos.deposito_id')
                                                                                                            ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                            ->where('estado','Preparando')
                                                                                                            ->where('pago','Impago')
                                                                                                            ->orderBy('pedidos.id','desc')
                                                                                                            ->paginate(500);
                    
                                                                                                    return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                    break;
                                                                                
                                                                                endswitch;

                                                            break;

                                                            case 'Cancelado':
                                                                                switch($statusPago):

                                                                                    case 'Todos':

                                                                                                $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                ->select('pedidos.num_pedido',
                                                                                                        'pedidos.fecha',
                                                                                                        'pedidos.cliente_id',
                                                                                                        'pedidos.usuario_id',
                                                                                                        'pedidos.estado',
                                                                                                        'pedidos.pago',
                                                                                                        'pedidos.id as id',
                                                                                                        'pedidos.total',
                                                                                                        'pedidos.deposito_id')
                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                ->where('estado','Cancelado')
                                                                                                ->orderBy('pedidos.id','desc')
                                                                                                ->paginate(500);
                    
                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                    break;

                                                                                    case 'Pagado':

                                                                                                    $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                                ->select('pedidos.num_pedido',
                                                                                                                        'pedidos.fecha',
                                                                                                                        'pedidos.cliente_id',
                                                                                                                        'pedidos.usuario_id',
                                                                                                                        'pedidos.estado',
                                                                                                                        'pedidos.pago',
                                                                                                                        'pedidos.id as id',
                                                                                                                        'pedidos.total',
                                                                                                                        'pedidos.deposito_id')
                                                                                                                ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                                ->where('estado','Cancelado')
                                                                                                                ->where('pago','Pagado')
                                                                                                                ->orderBy('pedidos.id','desc')
                                                                                                                ->paginate(500);
                                    
                                                                                                                return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                    break;

                                                                                    case 'Impago':

                                                                                                    $pedidos = Pedido::join('clientes','pedidos.cliente_id','=','clientes.id')
                                                                                                            ->select('pedidos.num_pedido',
                                                                                                                    'pedidos.fecha',
                                                                                                                    'pedidos.cliente_id',
                                                                                                                    'pedidos.usuario_id',
                                                                                                                    'pedidos.estado',
                                                                                                                    'pedidos.pago',
                                                                                                                    'pedidos.id as id',
                                                                                                                    'pedidos.total',
                                                                                                                    'pedidos.deposito_id')
                                                                                                            ->where('clientes.razon_Social','like','%'.$searchText.'%')
                                                                                                            ->where('estado','Cancelado')
                                                                                                            ->where('pago','Impago')
                                                                                                            ->orderBy('pedidos.id','desc')
                                                                                                            ->paginate(500);
                    
                                                                                                    return view('pedidos.search', compact('pedidos','vendedores'));

                                                                                    break;
                                                                                
                                                                                endswitch;

                                                            break;

                                            endswitch;

                                endswitch; 

                break;

            case 'num_pedido':

                                $pedidos = Pedido::where($searchCondicion,'like','%'.$searchText.'%')->paginate(200);       
                            
                                return view('pedidos.search', compact('pedidos','vendedores'));

                                break;
            
            default:

                    $pedidos = Pedido::with(['user','deposito','cliente'])
                                ->where('estado','not like','Cancelado')
                                ->where('estado','not like','Entregado')
                                ->orWhere('pago','not like', 'Pagado')
                                ->where('pago','not like','Cancelado')
                                ->orderBy('id', 'desc')
                                ->paginate(20);

                    return view('pedidos.search', compact('pedidos','vendedores'));
        endswitch; 

    
    }

    public function seleccionar(Request $request){

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
        return view('pedidos.seleccionarCliente',["clientes"=>$clientes,"provincias"=>$provincias]);

    }

    public function seleccionarNegocio($cliente){

        $cliente_id = $cliente;

        $user = User::find(Auth::user()->id);

        $unidadesnegocio_usuario = $user->unidades_negocios()->get();

        return view('pedidos.seleccionarNegocio',["cliente"=>$cliente_id,"unidades"=>$unidadesnegocio_usuario]);

    }

    public function create($cliente_id,$unidad_id){

            $cliente = Cliente::find($cliente_id);

            $usuarios = User::orderBy('apellido', 'ASC')->get();

            //$cajas = Cajas::find(1);

            $caja = Cajas::find(Auth::user()->caja_id);

            $dolar = Dolar::orderBy('id','desc')->firstOrFail();

            if($unidad_id == 4){

                $productos = Producto::join('deposito_producto','productos.id','=','deposito_producto.producto_id')
                ->join('depositos','depositos.id','=','deposito_producto.deposito_id')
                ->select('productos.id','productos.codigo','productos.moneda','productos.nombre','deposito_producto.stock','depositos.nombre as depositos',
                'productos.precioLocalB as local1','depositos.id as iddeposito')
                ->where('productos.unidadnegocio_id','=',4)
                ->orderBy('productos.id','desc')
                ->get();

            }
            else{

                if($cliente->facturacion == 'Si'){
                    $productos = Producto::join('deposito_producto','productos.id','=','deposito_producto.producto_id')
                    ->join('depositos','depositos.id','=','deposito_producto.deposito_id')
                    ->select('productos.id','productos.codigo','productos.moneda','productos.nombre','deposito_producto.stock','depositos.nombre as depositos',
                    'productos.precioLocal as local1','depositos.id as iddeposito')
                    ->where('productos.unidadnegocio_id','=',$unidad_id)
                    ->where('depositos.id','=',$caja->deposito_id)
                    ->where('productos.estado','not like','Desactivado')
                    ->orderBy('productos.id','desc')
                    ->get();
                }
                else{
                    $productos = Producto::join('deposito_producto','productos.id','=','deposito_producto.producto_id')
                    ->join('depositos','depositos.id','=','deposito_producto.deposito_id')
                    ->select('productos.id','productos.codigo','productos.moneda','productos.nombre','deposito_producto.stock','depositos.nombre as depositos',
                    'productos.precioLocalB as local1','depositos.id as iddeposito')
                    ->where('productos.unidadnegocio_id','=',$unidad_id)
                    ->where('depositos.id','=',$caja->deposito_id)
                    ->where('productos.estado','not like','Desactivado')
                    ->orderBy('productos.id','desc')
                    ->get();
                }

            }
    
            $unidad = Unidad_Negocio::find($unidad_id);
    
            $depositos = Deposito::orderBy('id', 'ASC')->where('id','<>','1')->get();
    
            return view('pedidos.creat',["cliente"=>$cliente,"productos"=>$productos,"depositos"=>$depositos,"unidad"=>$unidad,'usuarios'=>$usuarios,'dolar'=>$dolar]);

    }
    
  
    public function show($id)
    {
        $pedido = pedido::find($id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $detalle = $pedido->detalle_pedido()->get();

        $pagos = Pagos::where('pedido_id',$id)->orderBy('id','desc')->get();

        $depositos = Deposito::orderBy('nombre')->get();

        $suma = $pedido->detalle_pedido()->sum(DB::raw('cantidad * precio'));

        $date = ['pedido' => $pedido, 'pagos' => $pagos, 'dolar' => $dolar,'detalle'=>$detalle,'depositos'=>$depositos,'suma'=>$suma];

        if(Auth::user()->tipo == 'munay'):
            return view('munay.ventas.show', $date);
        else:
            return view('pedidos.show', $date);
        endif;
        
       
    }

    public function movimientoPedido($id){

        $pedido = pedido::find($id);
        
        $pedido->estado = "En Deposito";
        
        $pedido->save();

        $detalle = $pedido->detalle_pedido()->get();

        if (count( json_decode($detalle,true) ) > 0) {

            $detEnPedido = json_decode($detalle,true);
            $mytime = Carbon::now('America/Argentina/Tucuman');

            for ($i=0; $i < count($detEnPedido); $i++) { 
                
                //SE REALIZA EL MOVIMIENTO DE LOS PRODUCTOS AL DEPOSITO //
                
                $movimiento = new MovimientoDeposito();
                $movimiento->idpedido = $id;
                $movimiento->idDepositoOrigen = $detEnPedido[$i]['deposito_id'];
                $movimiento->idDepositoDestino = 1;
                $movimiento->idProducto = $detEnPedido[$i]['producto_id'];
                $movimiento->cantidad = $detEnPedido[$i]['cantidad'];
                $movimiento->save();

                //RESTA DEL STOCK RESERVADO DEL ORIGINAL //


                $depositoOrigen = DepositoProducto::where('producto_id','like',$movimiento->idProducto)
                ->where('deposito_id','like',$movimiento->idDepositoOrigen )
                ->firstOrFail();
                $depositoOrigen->stock_reservado = $depositoOrigen->stock_reservado -   $movimiento->cantidad;
                $depositoOrigen->save();

                //VERIFICA SI EXISTE ESE PRODUCTO EN EL DEPOSITO OSCURO//

                $depositoPedido = DepositoProducto::where('producto_id','like',$movimiento->idProducto)
                                                  ->where('deposito_id','like','1')
                                                  ->get();
                                                  
                //SI NO EXISTE, LO CREA

                if($depositoPedido->isEmpty())
                {
                    $depPedi = new DepositoProducto();
                    $depPedi->stock = $movimiento->cantidad;
                    $depPedi->stock_reservado =  0;
                    $depPedi->stock_critico = 0;
                    $depPedi->ubicacion = 'Estanterias';
                    $depPedi->deposito_id = 1;
                    $depPedi->producto_id = $movimiento->idProducto;
                    $depPedi->save();
                }  

                //SI EXISTE LE AUMENTA STOCK
                else
                {

                    $depositoPedido2 = DepositoProducto::where('producto_id','like',$movimiento->idProducto)
                                                        ->where('deposito_id','like','1')
                                                        ->firstOrFail();
                    $depositoPedido2->stock = $depositoPedido2->stock +   $movimiento->cantidad;
                    $depositoPedido2->save();
                }                           

            }
        }
        return redirect()->route('pedidos.index');
    }


    public function generarReportePDF()
    {
        $pedidos = Pedido::where('estado','not like','Cancelado')
        ->where('estado','not like','Entregado')
        ->orWhere('pago','not like', 'Pagado')
        ->orderBy('id', 'desc')
        ->get();

        $pdf = PDF::loadView('pedidos.listPDF',['pedidos'=>$pedidos])->setPaper('a4', 'landscape');
    
        return $pdf->stream();
    }

    public function generarReporteExcel()
    {
        return Excel::download(new PedidosExport, 'pedidos.xlsx');
    }

    public function eliminar($id){

        $pedido = Pedido::find($id);

        $pedido->estado = 'Cancelado';

        $pedido->pago = 'Cancelado';

        $pedido->save();

        $detalle = $pedido->detalle_pedido()->get();

        foreach($detalle as $registro){

            $depositoPedido = DepositoProducto::where('producto_id','like',$registro->producto_id)
            ->where('deposito_id','like',$registro->deposito_id)
            ->firstOrFail();

            $depositoPedido->stock = $depositoPedido->stock + $registro->cantidad;

            $depositoPedido->save();

        }

        return back()->with('message','Venta Cancelada')->with('typealert','success');

    }

    public function store(Request $request)
    {
        $mytime = Carbon::now('America/Argentina/Tucuman');

        $precioDolares = 0;

        $totalDolares = 0;

        $totalPesos = 0;

        $total_dedudor_Pesos = 0;

        $total_dedudor_Dolares = 0;

        //$cajas = cajas::find(Auth::user()->caja_id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();
        
        $cliente = Cliente::find($request->cliente_id);

        try{
            
            DB::beginTransaction();
            
            $mytime = Carbon::now('America/Argentina/Tucuman');
            
            $pedido = new Pedido;
            $pedido->cliente_id = $request->cliente_id;
            $pedido->usuario_id = Auth::user()->id;
            $pedido->num_pedido= '0';
            $pedido->fecha = $mytime->toDateTimeString();
            $pedido->tipo_entrega = $request->elegido;
            $pedido->modo_venta = $request->modoPago;
            $pedido->cotizacion =  $dolar->valor;
            if($request->modoPago == 'Ahora6' || $request->modoPago == 'Ahora12' || $request->modoPago == 'Ahora18')
            {

                if($request->modoPago == 'Ahora6'){
                    $total = $request->total_venta_pesos;
                    $pedido->total = $total + ($total * 0.08);
                }
                if($request->modoPago == 'Ahora12'){
                    $total = $request->total_venta_pesos;
                    $pedido->total = $total + ($total * 0.15);
                }
                if($request->modoPago == 'Ahora18'){
                    $total = $request->total_venta_pesos;
                    $pedido->total = $total + ($total * 0.20);
                }
                
            }
            else{
                $pedido->total = $request->total_venta_pesos;
            }
            $pedido->deposito_id = Auth::user()->caja->deposito_id;
            $pedido->unidad_id = $request->unidad_id;
            $pedido->observaciones = $request->observaciones;
            $pedido->tipo = "Pesos";        
            $pedido->estado = "Preparando";
            $pedido->pago = "Impago";  
            $pedido->save();

            if (count( json_decode($request->productosEnPedidos,true) ) > 0) {

                $proEnPedido = json_decode($request->productosEnPedidos,true);
                
                for ($i=0; $i < count($proEnPedido); $i++) { 

                    $producto = Producto::find($proEnPedido[$i]['idProducto']);

                    if($producto->moneda == 'Dolares'){
            
                        if($cliente->facturacion == 'Si'){
            
                            $precioDolares = $producto->precioLocal;
            
                        }
            
                        else{
                            $precioDolares = $producto->precioLocalB;
                        }

                        $subtotal = $precioDolares * $proEnPedido[$i]['cantidad'];
                        $descuento = $subtotal *  ( $proEnPedido[$i]['descuento']/100 );
                        $totalDolares = $totalDolares + ( $subtotal - $descuento );  
                 
                    }
            
                    else{

                        $subtotal = $proEnPedido[$i]['precio'] * $proEnPedido[$i]['cantidad'] ;
                        $descuento = $subtotal *  ( $proEnPedido[$i]['descuento']/100 );
                        $totalPesos = $totalPesos + ( $subtotal - $descuento );  
                    }
            
                    $detalle = new Detalle_Pedido();
                    
                    $detalle->pedido_id = $pedido->id;
                    
                    $detalle->producto_id = $proEnPedido[$i]['idProducto'];
                    
                    $detalle->deposito_id = $pedido->deposito_id;
                    
                    $detalle->cantidad = $proEnPedido[$i]['cantidad'];
                    
                    $detalle->precio = $proEnPedido[$i]['precio'];

                    $detalle->descuento = $proEnPedido[$i]['descuento'];
            
                    $detalle->precioDolares = $precioDolares;
            
                    $detalle->cotizacion =  $dolar->valor;
                    
                    $detalle->estado = 'Preparado';
                    
                    $detalle->save();                                 
                    
                    if($producto->unidadnegocio_id != 4){
                        $this->restarStock($detalle);
                    }
                }

            }

            if($request->modoPago == 'Cuenta Corriente'){

                $this->cuentaCorriente($cliente,$pedido, $totalDolares , $totalPesos);

            } 

            $numero_pedido = $this->agregarNumeroPedido($pedido->id,$totalDolares,$totalPesos,$totalDolares);

            if(Auth::user()->caja_id != 1){
                
                $this->cambiarEstado($pedido->id);

                if(Auth::user()->caja_id == 2 && $pedido->tipo_entrega == 'Envio a Domicilio'){ 
                    $this->crearTarea($numero_pedido,$cliente->razon_Social,$pedido->tipo_entrega,$pedido->id);
                    $this->moverPedido($pedido->id);
                }
            }
            else{
                $this->crearTarea($numero_pedido,$cliente->razon_Social,$pedido->tipo_entrega,$pedido->id);
            }

         
            DB::commit();
        }

        catch(Exception $e){  
            DB::rollback();
        }

        return redirect()->route('pedidos.index')->with('success','Pedido agregado correctamente');
        
        
    }

    private function agregarNumeroPedido($pedido_id,$montoDolares,$total_dedudor_Pesos,$total_dedudor_Dolares){
        
        $pedido = Pedido::find($pedido_id);
        $pedido->num_pedido = 'NVT-0'.Auth::user()->caja_id.'-'.date('Y').'-'.$pedido_id;
        $pedido->totalDolares = $montoDolares;
        $pedido->deuda_pesos = $total_dedudor_Pesos;
        $pedido->deuda_dolares = $total_dedudor_Dolares;
        $pedido->save();

        return  $pedido->num_pedido;
    }

    private function cambiarEstado($pedido_id){
        
        $pedido = Pedido::find($pedido_id);
        $pedido->estado = "Entregado";
        $pedido->save();

    }

    private function crearTarea($num_pedido,$nombreCliente,$formaEntrega,$pedido_id){

        $tarea = new Tarea;
        $tarea->detalle = 'Preparar Venta:'.$num_pedido.', Cliente '.' '. $nombreCliente . ', Envio: '.$formaEntrega;
        $tarea->estado = 'pendiente';
        $tarea->prioridad = 'urgencia';
        $tarea->fecha_inicio = date('Y-m-d H:i:s');
        $tarea->tipo_tarea_id = '2';
        $tarea->user_id = '5';
        $tarea->pedido_id = $pedido_id;
        $tarea->save();
    
        $movimientotarea = new Movimiento_Tarea;
        $movimientotarea->observaciones = 'Preparar Venta';
        $movimientotarea->fecha_movimiento = date('Y-m-d H:i:s');
        $movimientotarea->tarea_id = $tarea->id;
        $movimientotarea->user_id = '5';
        $movimientotarea->save();
    }

    private function restarStock(Detalle_Pedido $detalle){

        $depositoPedido = DepositoProducto::where('producto_id','like',$detalle->producto_id)
        ->where('deposito_id','like',$detalle->deposito_id)
        ->firstOrFail();

        $depositoPedido->stock = $depositoPedido->stock -  $detalle->cantidad;

        $depositoPedido->save();

    }

    private function cuentaCorriente(Cliente $cliente,Pedido $pedido, $totalDolares , $totalPesos){

        $cliente->montoCuenta =  $cliente->montoCuenta - $totalDolares;

        $cliente->montoCuentaPesos =  $cliente->montoCuentaPesos -  $totalPesos;
            
        $cliente->save();

        $pago = new Pagos_Cuenta();
            
        $pago->pedido_id = $pedido->id;

        $pago->cliente_id = $cliente->id;

        $pago->moneda = 'Pesos';
            
        $pago->montoRestante =  $totalDolares;

        $pago->montoRestantePesos = $totalPesos;
            
        $pago->estado = 'Impago';
            
        $pago->save();
    }

    private function moverPedido($id){
        $pedido = Pedido::find($id);
        $pedido->deposito_id = '1';
        $pedido->save();
    }

    public function update(Request $request,$id)
    {

        try{
            
            DB::beginTransaction();
                        
            $pedido = Pedido::find($id);
            $pedido->modo_venta = $request->modoPago;
            $pedido->deposito_id = $request->deposito_id;      
            $pedido->estado =  $request->estado;
            $pedido->save();
            
            DB::commit();
        }

        catch(Exception $e){  
            DB::rollback();
        }

        return back()->with('success','Pedido agregado correctamente');
        
    }

}