<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pedido;
use App\Servicio;
use App\Producto_Servicio;

use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function showPagosPendientes($id){

        $pagosPedidos = Pedido::join('movimiento_caja','pedidos.id','=','movimiento_caja.pedido_id')
        ->select('pedidos.num_pedido','movimiento_caja.id','movimiento_caja.entrada','movimiento_caja.forma','movimiento_caja.tipo','movimiento_caja.created_at')
        ->where('pedidos.id','=',$id)   
        ->orderBy('movimiento_caja.id','desc')                      
        ->get();

        return $pagosPedidos;

    } 

}
