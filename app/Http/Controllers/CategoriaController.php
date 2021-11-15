<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Validator;

class CategoriaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index()
    {
        $categorias = Categoria::orderBy('nombre', 'DESC')->paginate(10);

        return view('admin.categorias.index', compact('categorias'));

    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|max:20',
        ];

        $message = [
            
            'nombre.requiered' => 'Ingrese Nombre de la Categoria',

            'nombre.max' =>'El nombre del estudiante no puede ser mayor a :max caracteres.'
        ];

        $validator = Validator::make($request->all(),$rules,$message);

        if( $validator->fails()):
            
            return back()->withErrors($validator)->with('message','Se ha Producido un Error')->with('typealert','danger');

        else:

            $categoria = new Categoria();

            $categoria->nombre = $request->nombre;
    
            $categoria->save();
            
        endif;

        

        return redirect()->route('categorias.index')->with('success','producto agregado correctamente');
    }
    
}
