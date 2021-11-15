<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Proveedor;
use App\Provincia;
use App\Rubro;
use App\Unidad_Negocio;
use Barryvdh\DomPDF\Facade as PDF;

class ProveedorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index()
    {
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        $unidadesnegocio = Unidad_Negocio::orderBy('nombre', 'ASC')
                            ->select('nombre as nombre', 'id as id')
                            ->get();

        $provincias = Provincia::orderBy('nombre', 'ASC')
                      ->select('nombre as nombre', 'id as id')
                      ->get();

        $rubros = Rubro::orderBy('nombre', 'ASC')
                      ->select('nombre as nombre', 'id as id')
                      ->get();

        return view('proveedores.create',compact('unidadesnegocio', 'provincias', 'rubros'));
    }


    public function store(Request $request)
    {
        $provedor = new Proveedor;
        $provedor->nombre = $request->nombre;
        $provedor->razon_Social = $request->razonSocial;
        $provedor->datoBancario = $request->datoBancario;
        
        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $uniqueFileName = $provedor->nombre . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/logos');
            $request->img->move($destino,$uniqueFileName);         
            $provedor->logo = $uniqueFileName;
        }

        $provedor->cuit_cuil = $request->cuit_cuil;
        $provedor->telefonos = $request->telefonos;
        $provedor->email = $request->email;
        $provedor->direccion = $request->direccion;
        $provedor->ciudad = $request->ciudad;
        $provedor->codigo_postal = $request->codigo_postal;
        $provedor->provincia_id = $request->provincia_id;
        $provedor->rubro_id = $request->rubro_id;
        $provedor->save();

        if( count($request->unidadnegocio_id)  > 0 ){
            foreach ($request->unidadnegocio_id as $value) {
                $provedor->unidades_negocios()->attach($value);
            }
        }

        return redirect()->route('proveedores.index');
    }

    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        
        $unidadesnegocio_proveedor= $proveedor->unidades_negocios()->get();
        
        $contactos= $proveedor->contactos()->get();
        
        return view('proveedores.show', compact('proveedor', 'unidadesnegocio_proveedor','contactos'));
    }

    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        $unidadesnegocio = Unidad_Negocio::All();
        $rubros = Rubro::orderBy('nombre', 'ASC')->select('nombre as nombre', 'id as id')->get();
        $provincias = Provincia::orderBy('nombre', 'ASC')->select('nombre as nombre', 'id as id')->get();
        $proveedoresUnidadNegocios = $proveedor->unidades_negocios;
        return view('proveedores.edit', compact('proveedor','unidadesnegocio','proveedoresUnidadNegocios','rubros','provincias'));
    }

    public function update(Request $request, $id)
    {
        $provedor = Proveedor::find($id);
        $provedor->nombre = $request->nombre;
        $provedor->razon_Social = $request->razonSocial;
        $provedor->datoBancario = $request->datoBancario;

        if($request->hasFile('img'))
        {
            $file = $request->file('img');
            $uniqueFileName = $provedor->nombre . '.' . $file->getClientOriginalExtension();
            $destino = public_path('img/logos');
            $request->img->move($destino,$uniqueFileName);         
            $provedor->logo = $uniqueFileName;
        }
        
        $provedor->cuit_cuil = $request->cuit_cuil;
        $provedor->telefonos = $request->telefonos;
        $provedor->email = $request->email;
        $provedor->direccion = $request->direccion;
        $provedor->ciudad = $request->ciudad;
        $provedor->codigo_postal = $request->codigo_postal;
        $provedor->provincia_id = $request->provincia_id;
        $provedor->rubro_id = $request->rubro_id;
        $provedor->save();
        
        if( count($request->unidadnegocio_id)  > 0 ){
            foreach ($request->unidadnegocio_id as $value) {
                $provedor->unidades_negocios()->attach($value);
            }
        }

        return redirect()->route('proveedores.show',$id)->with('success','Proveedores actualizado correctamente');
    }

    public function listadoProveedores ()
    {
        $proveedores = Proveedor::orderBy('nombre', 'ASC')->get();

        $pdf = PDF::loadView('pdf.proveedorespdf',['proveedores'=>$proveedores])->setPaper('a4', 'landscape');
    
        return $pdf->stream();
    }

}
