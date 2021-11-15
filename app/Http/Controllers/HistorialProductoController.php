<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto_en_Servicio;
use App\Historial_Producto_Servicio;
use App\Servicio;

class HistorialProductoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index(Request $request)
    {
        $productosEnServicios = Producto_en_Servicio::BuscarProducto($request->get('numero_serie'))
                                ->orderBy('idProductos_en_servicios', 'ASC')
                                ->paginate(10);
                                //dd($productosEnServicios);
        return view('historiales.index',compact('productosEnServicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $historial = new Historial_Producto_Servicio();
        $historial->detalle = $request->detalle;
        $historial->idProd_en_serv = $request->idProductos_en_servicios;
        $historial->save();

        $servicio = Servicio::findOrFail($request->idServicios);
        $productosDelServicio = $servicio->productosEnServicios()->get();
        $productoEnServicio = $productosDelServicio->find($request->idProductos_en_servicios);

        if(($request->estado == 1 && $productoEnServicio->estado == 'alquilado' ) || ($request->estado == 2 && $productoEnServicio->estado == 'libre' ) ){

        }else{
            if ($request->estado == 1) {
                $productoEnServicio->pivot->estado = 'activo';
                $productoEnServicio->pivot->fecha_baja = null;
                $productoEnServicio->pivot->updated_at = date('Y-m-d h:m:s');
                $productoEnServicio->pivot->save();
                $productoEnServicio->estado = 1;
                $productoEnServicio->save();
            }else{
                $productoEnServicio->pivot->estado = 'inactivo';
                $productoEnServicio->pivot->fecha_baja = date('Y-m-d h:m:s');
                $productoEnServicio->pivot->updated_at = date('Y-m-d h:m:s');
                $productoEnServicio->pivot->save();
                $productoEnServicio->estado = 2;
                $productoEnServicio->save();
            }
        }

        // Historial_Producto_Servicio::findOrFail($request->idProductos_en_servicios);

        
        return redirect()->route('historiales.index')->with('success','historiales agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productoEnServicio = DB::table('productos_en_servicios')
        ->join('productos', 'productos_en_servicios.productos_idProductos', '=', 'productos.idProductos')
        ->select('productos_en_servicios.*','productos.nombre as prod_nombre', 'productos.*')
        ->where('productos_en_servicios.idProductos_en_servicios','=',$id)->get();
        //dd($productoEnServicio);
        $historiales = DB::table('historial_producto_en_servicio')
        ->join('productos_en_servicios', 'historial_producto_en_servicio.idProd_en_serv', '=', 'productos_en_servicios.idProductos_en_servicios')
        ->where('productos_en_servicios.idProductos_en_servicios','=',$id)->get();
        //dd($historiales);
        return view('historiales.showHistorial', compact('historiales','productoEnServicio'));
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
}
