<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidad_Negocio;
use App\User;
use App\Provincia;
use Validator,Hash,Auth,Str,Config,Image;

class UnidadNegocioController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    public function index(Request $request)
    {

        $searchText = $request->searchText;

        if($searchText){

            $unidadesnegocio = Unidad_Negocio::where('nombre','like','%'.$searchText.'%')->orderBy('id', 'DESC')->paginate(10);
           
        }
        else{
            $unidadesnegocio = Unidad_Negocio::orderBy('nombre', 'ASC')->paginate(10);
        }
        
        $date = ['unidadesnegocio' => $unidadesnegocio];

        return view('unidadnegocio.index', $date);
    }


    public function create()
    {
        $provincias = Provincia::orderBy('nombre', 'ASC')->pluck('nombre','id');

        $date = ['provincias' => $provincias];
        
        return view('unidadnegocio.create',$date);
    }

    public function store(Request $request)
    {
        $rulesValidation = [
            'nombre' => 'required',
            'direccion' => 'required',
        ];

        $messages = [
            'nombre.required' => 'El Nombre de la Unidad de Negocio es Obligatorio',
            'direccion.required' => 'Se Necesita una Direccion',
        ];

        $validator = Validator::make($request->all(),$rulesValidation,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error','typealert','danger')->withInput();
        else:

            $unidadnegocio = new Unidad_Negocio;
            $unidadnegocio->nombre = $request->nombre;
            $unidadnegocio->direccion = $request->direccion;
            $unidadnegocio->telefonos = $request->telefonos;
            $unidadnegocio->cuit = $request->cuit;
            $unidadnegocio->ciudad = $request->ciudad;
            $unidadnegocio->codigo_postal = $request->codigo_postal;
            $unidadnegocio->provincia_id = $request->provincia_id;

            if($request->hasFile('img')):
                $file = $request->file('img');
                $uniqueFileName =rand(1,999).'-'.$request->logo . '.' . $file->getClientOriginalExtension();
                $destino = public_path('/img/unidades');
                $request->img->move($destino,$uniqueFileName);         
                $unidadnegocio->imagen = $uniqueFileName;
            endif;
        
            if($unidadnegocio->save()):
                return redirect()->route('unidades.index')->with('message','Unidad de Negocio Registrado con exito','typealert','success');
            endif;

        endif;

    }

    public function show($id)
    {
        $unidad = Unidad_Negocio::findOrFail($id);

        $date = ['unidad' => $unidad];

        return view('unidadnegocio.show', compact('unidad'));
    }
    
    public function edit($id)
    {
        $unidad = Unidad_Negocio::findOrFail($id);

        $provincias = Provincia::orderBy('nombre', 'ASC')->pluck('nombre','id');

        $date = ['unidad' => $unidad,'provincias' => $provincias];

        return view('unidadnegocio.edit', $date);
    }

    public function update(Request $request, $id)
    {
        $rulesValidation = [
            'nombre' => 'required',
            'direccion' => 'required',
        ];

        $messages = [
            'nombre.required' => 'El Nombre de la Unidad de Negocio es Obligatorio',
            'direccion.required' => 'Se Necesita una Direccion',
        ];

        $validator = Validator::make($request->all(),$rulesValidation,$messages);

        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error','typealert','danger')->withInput();
        else:

            $unidadnegocio = Unidad_Negocio::find($id);
            $unidadnegocio->nombre = $request->nombre;
            $unidadnegocio->direccion = $request->direccion;
            $unidadnegocio->telefonos = $request->telefonos;
            $unidadnegocio->cuit = $request->cuit;
            $unidadnegocio->ciudad = $request->ciudad;
            $unidadnegocio->codigo_postal = $request->codigo_postal;
            $unidadnegocio->provincia_id = $request->provincia_id;
        
            if($request->hasFile('img')):
                $file = $request->file('img');
                $uniqueFileName =rand(1,999).'-'.$request->nombre . '.' . $file->getClientOriginalExtension();
                $destino = public_path('/img/unidades');
                $request->img->move($destino,$uniqueFileName);         
                $unidadnegocio->imagen = $uniqueFileName;
            endif;

            if($unidadnegocio->save()):
                return redirect()->route('unidades.index')->with('message','Unidad de Negocio Actualizado con exito','typealert','success');
            endif;

        endif;
    }


    public function delete($id){
        $unidad = Unidad_Negocio::findOrFail($id);
        if($unidad->delete()):
            return redirect('/unidades')->with('message','UNIDAD DE NEGOCIO ELIMINADA','typealert','danger');;
        endif;
    }

}
