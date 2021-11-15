<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovimientoDeposito;
use App\Producto;
use App\Deposito;
use App\HistorialMovimientos;
use App\DepositoProducto;
use App\Detalle_Pedido;
use App\Pedido;
use App\Movimiento;
use DB;
use Carbon\Carbon;
use Response;

class MovimientoDepositoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index()
    {
        
        $movimientos = Movimiento::orderBy('id', 'DESC')->paginate(10);
        
        return view('movimientos.index', compact('movimientos'));
    }

    public function show($id)
    {
        $movimiento = Movimiento::find($id);

        $detalle = MovimientoDeposito::where('idMovimiento','=',$id)->get();

        return view('movimientos.show', compact('movimiento','detalle'));
    }

}