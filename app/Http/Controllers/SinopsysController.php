<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Dolar;
use App\Unidad_Negocio;
use App\Categoria;
use App\DepositoProducto;
use App\Deposito;
use Validator;

class SinopsysController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    public function productos(Request $request){

        $dolar = Dolar::orderBy('id','desc')->firstOrFail();

        $searchText = $request->searchText;

        if($searchText){

            $articulos = Producto::where('nombre','LIKE','%'.$searchText.'%')->where('unidadnegocio_id','=','7')->orderBy('nombre', 'ASC')->paginate(50);
        
        }
        else{
        
            $articulos = Producto::where('unidadnegocio_id','=','7')->orderBy('nombre', 'ASC')->paginate(25);
        
        }
        
        return view('sinopsys.productos.index', compact('articulos','dolar'));

    }

    public function productosCreate(Request $request){  

        $categorias = Categoria::where('nombre','Cuaderno')->orWhere('nombre','Sobres')->orderBy('nombre', 'ASC')->pluck('nombre','id');;

        $date = ['categorias' => $categorias];

        return view('sinopsys.productos.create',$date);

    }

    public function productostore(Request $request)
    {

        $rulesValidation = [
            'nombre' => 'required',
            'p_local_1p' => 'required',
        ];

        $messages = [
            'nombre.required' => 'Hace Falta un Nombre para el Producto',
            'p_local_1p.required' => 'Falta Precio del Producto',
        ];

        $validator = Validator::make($request->all(),$rulesValidation,$messages);

        if($validator->fails()):
        
            return back()->withErrors($validator)->with('message','Se ha producido un error','typealert','danger')->withInput();
        
        else:

            $producto = new Producto();        
            $producto->codigo = 0;
            $producto->nombre = e($request->input('nombre'));
            $producto->descripcion = e($request->input('descripcion'));
            $producto->precioLocal = e($request->input('p_local_1p'));
            $producto->precioLocalDolares = '0';
            $producto->moneda = e($request->input('moneda'));
            $producto->precioLocalB = e($request->input('p_local_1p')); 
            $producto->precioLocalDolaresB = '0';    
            $producto->precioMercadoLibre = '0';    
            $producto->precioEccomerce = '0';
            $producto->categoria_id = $request->categoria_id;
            $producto->marcas_id = $request->categoria_id;
            $producto->unidadnegocio_id = '7';

            if($producto->save()):

                return redirect()->route('sinopsys.productos')->with('message','Deposito Creado con exito','typealert','success');;


            endif;

        endif;
    }


}
