<?php

namespace App\Http\Controllers;
use App\Producto;
use App\Cajas;
use App\Material;
use App\Producto_Material;
use App\Unidad_Negocio;
use App\DepositoProducto;
use App\Dolar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CotizadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index(Request $request)
    {
        //$cajas = Cajas::find(Auth::user()->caja_id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $searchText = $request->searchText;
  
        if($searchText){

            $articulos = Producto::where('nombre','LIKE','%'.$searchText.'%')->where('unidadnegocio_id','=','4')->orderBy('nombre', 'ASC')->paginate(50);
        
        }
        else{
        
            $articulos = Producto::where('unidadnegocio_id','=','4')->orderBy('nombre', 'ASC')->paginate(25);
        
        }
        
        return view('cotizaciones.index', compact('articulos','dolar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiaPrimas = Material::orderBy('descripcion','desc')->get();

        //$cajas = Cajas::find(Auth::user()->caja_id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        if(Auth::user()->tipo == 'munay'):
            return view('munay.productos.create', compact('materiaPrimas','dolar'));
        else:
            return view('cotizaciones.create', compact('materiaPrimas','dolar'));
        endif;

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto;
        
        $producto->codigo = '0';
        
        $producto->nombre = $request->nombre;
        
        $producto->descripcion = $request->descripcion;

        $producto->precioLocal = $request->precioFinal;
        
        $producto->precioLocalDolares = 0;
        
        $producto->moneda = 'Pesos';

        $producto->precioLocalB = $request->precioFinal;
        
        $producto->precioLocalDolaresB = '0';
        
        $producto->precioMercadoLibre = '0';
        
        $producto->precioEccomerce = '0';

        $producto->beneficio = $request->beneficio;

        $producto->categoria_id = 1;

        $producto->marcas_id = 1;

        $producto->unidadnegocio_id= $request->unidad_id;

        if($request->hasFile('imagen'))
        {
            $file = $request->file('imagen');
            $uniqueFileName = $producto->nombre . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/productos');
            $request->img->move($destino,$uniqueFileName);         
            $producto->imagen = $uniqueFileName;
        }

        $producto->save();

        if (count( json_decode($request->productosEnPedidos,true) ) > 0) {

            $proEnPedido = json_decode($request->productosEnPedidos,true);
            
            for ($i=0; $i < count($proEnPedido); $i++) { 
        
                $detalle = new Producto_Material();
                
                $detalle->producto_id = $producto->id;
                
                $detalle->material_id = $proEnPedido[$i]['idmateria'];
                
                $detalle->cantidad = $proEnPedido[$i]['cantidad'];
                
                $detalle->save();                                 
            }
        }

        $deposito = new DepositoProducto();

        $deposito->stock = 0;

        $deposito->ubicacion = 'Estanterias';

        $deposito->producto_id = $producto->id;

        $deposito->deposito_id = '5';

        $deposito->save();

        if(Auth::user()->tipo == 'munay'):
            return redirect()->route('munay.productos')->with('success','producto actualizado correctamente');
        else:
            return redirect()->route('cotizaciones.index')->with('success','producto actualizado correctamente');
        endif;

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materiaPrimas = Producto_Material::where('producto_id','=',$id)->get();
       
        if(count($materiaPrimas) == 0){
            $producto = Producto::find($id);
        }
        else{
            $producto = Producto::join('productos_material','productos.id','productos_material.producto_id')
            ->join('materias_primas','productos_material.material_id','materias_primas.id')
            ->select('productos.imagen',
                    'productos.nombre',
                    'productos.descripcion',
                    'productos.unidadnegocio_id',
                    'productos.beneficio',
                    'productos.precioLocal',
                    'productos.id',
                    DB::raw('sum(productos_material.cantidad * materias_primas.costo) as cantidad'))
            ->where('productos.id','=',$id)
            ->groupBy('productos.imagen',
                    'productos.nombre',
                    'productos.descripcion',
                    'productos.unidadnegocio_id',
                    'productos.beneficio',
                    'productos.precioLocal',
                    'productos.id')
            ->firstOrFail();
        }

        $materias = Material::orderBy('descripcion','desc')->get();

        return view('cotizaciones.show', compact('producto','materiaPrimas','materias'));
       

    }

    public function añadir(Request $request)
    {
        $materiaPrimas = new Producto_Material();

        $materiaPrimas->producto_id = $request->producto_id;

        $materiaPrimas->material_id = $request->material_id;
                
        $materiaPrimas->cantidad = $request->cantidad;
                
        $materiaPrimas->save(); 

        return back();
    }

    public function editar($id)
    {
        $producto = Producto::find($id);
        
        return view('cotizaciones.edit', compact('producto'));
    }

    public function modificar(Request $request,$id)
    {
        $producto = Producto::find($id);
        
        $producto->codigo = '0';
        
        $producto->nombre = $request->nombre;
        
        $producto->descripcion = $request->descripcion;

        $producto->precioLocal = $request->precioFinal;

        $producto->precioLocalB = $request->precioFinal;
        
        $producto->beneficio = $request->beneficio;

        $producto->unidadnegocio_id= $request->unidad_id;

        if($request->hasFile('imagen'))
        {
            $file = $request->file('imagen');
            $uniqueFileName = $producto->nombre . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/productos');
            $request->img->move($destino,$uniqueFileName);         
            $producto->imagen = $uniqueFileName;
        }

        $producto->save();

        return redirect()->route('cotizaciones.index');

    }

    public function update(Request $request)
    {
        $materiaPrimas = Producto_Material::find($request->id);
                
        $materiaPrimas->cantidad = $request->cantidad;
                
        $materiaPrimas->save(); 

        return back();
    }

    public function destroy($id)
    {
        $materiaPrimas = Producto_Material::find($id);
                
        $materiaPrimas->delete();
                
        return back();

    }
}
