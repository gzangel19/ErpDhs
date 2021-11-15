<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Producto;
use App\Servicio;
use App\Cajas;
use App\Dolar;
use App\Material;
use App\Unidad_Negocio;
use App\Categoria;
use App\DepositoProducto;
use App\Deposito;
use App\Producto_Componente;
use App\User;
use App\productos_numerados;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Illuminate\Support\Facades\Auth;

class ProductosController extends Controller
{

    public function __construct(){
        
        $this->middleware('auth');

        $this->middleware('userStatus');

    }
    
    public function unidades(){

        $unidadesnegocio = Auth::user()->unidades_negocios()->paginate(15);

        $date = ['unidadesnegocio' => $unidadesnegocio];

        return view('productos.unidades',$date);

    }

    public function index(Request $request,$id)
    {
        $searchText = $request->searchText;

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();
  
        $unidades = Unidad_Negocio::find($id);

        if($searchText){

            $articulos = Producto::where('nombre','LIKE','%'.$searchText.'%')->where('unidadnegocio_id','=',$id)->orderBy('nombre', 'ASC')->paginate(50);
        
        }
        else{
        
            $articulos = Producto::where('unidadnegocio_id','=',$id)->orderBy('nombre', 'ASC')->paginate(50);
        
        }
        
        return view('productos.index', compact('articulos','unidades','dolar'));
    }


    public function create($id)
    {
        $dolar = Dolar::orderBy('id','desc')->firstOrFail();
  
        $categorias = Categoria::All();

        $unidades = Unidad_Negocio::find($id);

        $marcas = Categoria::All();

        if($id==4){
            
            $materiaPrimas = Material::orderBy('descripcion','desc')->get();

            $cajas = cajas::find(Auth::user()->caja_id);
        
            return view('cotizaciones.create', compact('materiaPrimas','cajas','dolar'));

        }

        else{
            return view('productos.create', compact('unidades','categorias','marcas','dolar'));
        }
        
        
    }

    public function store(Request $request)
    {
        $producto = new Producto();
        
        $producto->codigo = 0;
        
        $producto->nombre = $request->nombre;
        
        $producto->descripcion = $request->descripcion;

        $producto->precioLocal = $request->p_local_1p;
        
        $producto->precioLocalDolares = '0';
        
        $producto->moneda = $request->moneda;

        $producto->precioLocalB = $request->p_local_2p;
        
        $producto->precioLocalDolaresB = '0';
        
        $producto->precioMercadoLibre = '0';
        
        $producto->precioEccomerce = $request->p_e;

        $producto->categoria_id = $request->categoria_id;

        $producto->marcas_id = $request->categoria_id;

        $producto->unidadnegocio_id = $request->unidad_negocio_idUnidad_negocio;

        $producto->save();

        $deposito = new DepositoProducto();

        $deposito->stock = 0;

        $deposito->ubicacion = 'Estanterias';

        $deposito->producto_id = $producto->id;

        $deposito->deposito_id = '2';

        $deposito->save();

        return redirect()->route('getProductos',$producto->unidadnegocio_id)->with('success','producto agregado correctamente');
    }

    public function show($id)
    {
        $producto = Producto::find($id);

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        return view('productos.show', compact('producto','dolar'));
    }


    public function edit($id)
    {
        $producto = Producto::find($id);

        $categorias = Categoria::All();

        $marcas = Categoria::All();
        
        $unidadesnegocio = Unidad_Negocio::All();
        
        return view('productos.edit', compact('producto','unidadesnegocio','categorias','marcas'));
    }


    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);
        
        $producto->codigo = $request->codigo;
        
        $producto->nombre = $request->nombre;
        
        $producto->descripcion = $request->descripcion;

        $producto->precioLocal = $request->p_local_1p;
        
        $producto->precioLocalDolares = '0';
        
        $producto->moneda = $request->moneda;

        $producto->precioLocalB = $request->p_local_2p;
        
        $producto->precioLocalDolaresB = '0';
        
        $producto->precioMercadoLibre = '0';
        
        $producto->precioEccomerce = $request->p_e;

        $producto->categoria_id = $request->categoria_id;

        $producto->marcas_id = $request->categoria_id;

        $producto->unidadnegocio_id= $request->unidad_negocio_idUnidad_negocio;

        $producto->estado = $request->estado;

        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $uniqueFileName = $producto->nombre . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/productos');
            $request->img->move($destino,$uniqueFileName);         
            $producto->img = $uniqueFileName;
        }

        $producto->save();

        return redirect()->route('getProductos',$producto->unidadnegocio_id)->with('success','producto actualizado correctamente');
    }

    public function listadoProductos()
    {
        $productos = Producto::orderBy('nombre', 'ASC')->get();

        $pdf = PDF::loadView('pdf.productospdf',['productos'=>$productos])->setPaper('a4', 'landscape');
    
        return $pdf->stream();
    }


    

}