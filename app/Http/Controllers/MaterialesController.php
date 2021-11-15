<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\Cajas;

class MaterialesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }

    public function index(Request $request)
    {
        
        $searchText = $request->searchText;
 
        if($searchText){
        
            $materiales = Material::where('descripcion','like','%'.$searchText.'%')->paginate(100);
        }
        else{
            $materiales = Material::orderBy('descripcion', 'DESC')->paginate(20);
        }
  
        return view('materiaPrima.index', compact('materiales'));
    }
    
    public function store(Request $request)
    {
        $material = new Material();
                        
        $material->descripcion = $request->descripcion;

        $material->detalle = $request->detalle;

        $material->costo = $request->costo;

        $material->moneda = $request->moneda;

        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $uniqueFileName = $material->descripcion . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/productos');
            $request->img->move($destino,$uniqueFileName);         
            $material->imagen = $uniqueFileName;
        }

        $material->save();

        return redirect()->route('materiales.index')->with('success','producto agregado correctamente');
    }

    public function update(Request $request)
    {
        $material = Material::find($request->material_id);
                        
        $material->descripcion = $request->descripcion;

        $material->detalle = $request->detalle;

        $material->costo = $request->costo;

        $material->moneda = $request->moneda;

        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $uniqueFileName = $material->descripcion . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/productos');
            $request->img->move($destino,$uniqueFileName);         
            $material->imagen = $uniqueFileName;
        }

        $material->save();

        return redirect()->route('materiales.index')->with('success','producto agregado correctamente');
    }

}
