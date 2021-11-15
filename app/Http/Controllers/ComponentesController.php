<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto_Componente;

class ComponentesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('userStatus');
    }
    
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $componente = new Producto_Componente();
                
        $componente->nombre = $request->nombre;

        $componente->cantidad = $request->cantidad;
        
        $componente->costo = $request->costo;

        $componente->beneficio = $request->beneficio;
        
        $componente->producto_id = $request->producto_id;

        $componente->save();

        return redirect()->route('productos.showMunay',$componente->producto_id)->with('success','producto agregado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
