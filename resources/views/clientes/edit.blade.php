@extends('layouts.app')

@section('title','Editar Cliente')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/clientes')}}" class="nav-link"> <i class="fas fa-address-card"></i> Clientes  </a>
                                    
    </li>

    <li class="breadcrumb-item">
            
        <a href="{{url('/clientes/edit/'.$cliente->id)}}" class="nav-link"> <i class="fas fa-edit"></i> Editar Cliente </a>
                                                                    
    </li>

@endsection


@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="{{url('/clientes/edit/'.$cliente->id)}}"> <i class="fas fa-edit"></i> Editar Cliente </a>  </h2> 
      
      </div>

      <div class="inside">

        {!! Form::open(['url'=>'clientes/update/'.$cliente->id]) !!}

            <div class="row">
                            
                <div class="col-md-6">
                              
                    <label for="name">Nombre:</label>

                    <div class="input-group">
                                      
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                  
                        {!!Form::text('nombre',$cliente->razon_Social,['class' => 'form-control'])!!}    
                                  
                    </div>
                                      
                </div>
          
                <div class="col-md-3">
                            
                    <label for="genero"> Genero </label>

                    <div class="input-group">
                                    
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                
                      {!!Form::select('genero',['masculino' => 'Masculino','femenino' => 'Femenino','otro' => 'Otro'],$cliente->genero,['class' => 'form-select'])!!}    
                                
                    </div>
                                    
                </div>
                
            </div>
                
            <div class="row mtop16">

                <div class="col-md-6">
                            
                    <label for="genero"> C.U.I.T / C.U.I.L </label>

                    <div class="input-group">
                                    
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                
                      {!!Form::text('cuit',$cliente->cuit_cuil,['class' => 'form-control'])!!} 
                                
                    </div>
                                    
                </div>

                <div class="col-md-3">
                            
                    <label for="genero"> Tipo </label>
        
                        <div class="input-group">
                                            
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        
                            {!!Form::select('tipo',['persona' => 'Fisico','empresa' => 'Empresa'],$cliente->tipo,['class' => 'form-select'])!!}    
                                        
                        </div>
                                            
                </div>

            </div>

            <div class="row mtop16">
                            
                <div class="col-md-6">
                                          
                    <label for="name">Telefonos:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('telefonos',$cliente->telefonos,['class' => 'form-control'])!!}    
                                              
                        </div>
                                                  
                </div>

                <div class="col-md-6">
                                          
                    <label for="name">Correo Electronico:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('email',$cliente->email,['class' => 'form-control'])!!}    
                                              
                        </div>
                                                  
                </div>
                        
            </div>

            <div class="row mtop16">
                            
                <div class="col-md-3">
                                          
                    <label for="name">Direccion:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('direccion',$cliente->direccion,['class' => 'form-control'])!!}    
                                              
                        </div>
                                                  
                </div>

                <div class="col-md-2">
                                          
                    <label for="name">Codigo Postal:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('codigo_postal',$cliente->codigo_postal,['class' => 'form-control'])!!}    
                                              
                        </div>
                                                  
                </div>

                <div class="col-md-3">
                                          
                    <label for="name">Localidad</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('ciudad',$cliente->ciudad,['class' => 'form-control'])!!}    
                                              
                        </div>
                                                  
                </div>

                <div class="col-md-4">
                                          
                    <label for="name">Provincia:</label>
            
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                        {!!Form::select('provincia_id',$provincias,$cliente->provincia_id,['class' => 'form-select'])!!}   
                                              
                    </div>
                                                  
                </div>
                        
            </div>

            @if (getValueJS(Auth::user()->permisosERP,'clientesCuentas'))

            <div class="row mtop16">
                            
                <div class="col-md-3">
                                
                    <label for="name">Factura?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                        {!!Form::select('facturacion',['Si' => 'Si','No' => 'No'],$cliente->facturacion,['class' => 'form-select'])!!}    
                                
                    </div>
                
                </div>

                <div class="col-md-3">
                                
                    <label for="name"> Cuenta Corriente?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                        {!!Form::select('cuentaCorriente',['Si' => 'Si','No' => 'No'],$cliente->cuentaCorriente,['class' => 'form-select'])!!}    
                                
                    </div>
                
                </div>       
                
                <div class="col-md-3">
                                
                    <label for="name"> Monto Dolares?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        
                        {!!Form::text('montoCuenta',$cliente->montoCuenta,['class' => 'form-control'])!!}       
                    
                    </div>
                
                </div>                  
                
                <div class="col-md-3">
                                
                    <label for="name"> Monto Pesos?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        
                        {!!Form::text('montoCuentaPesos',$cliente->montoCuentaPesos,['class' => 'form-control'])!!}
          
                    </div>
                
                </div>  
            </div>           

            @endif  

            <div class="row mtop16">
                            
                <div class="col-md-12">
                                
                    {!!Form::submit('Guardar',['class' => 'btn btn-success']) !!}    
                                        
                    {!!Form::reset('Cancelar',['class' => 'btn btn-danger']) !!} 
                
                </div>

            </div>

        {!! Form::close() !!}

      </div>
            
    </div>
    
</div>
    
@endsection
