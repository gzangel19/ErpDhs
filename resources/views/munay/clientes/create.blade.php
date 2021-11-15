@extends('layouts.munay')

@section('title','Nuevo Cliente')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('Munay/Clientes')}}" class="nav-link"> <i class="fas fa-address-card"></i> Clientes  </a>
                                    
    </li>

    <li class="breadcrumb-item">
                                        
        <a href="{{url('Munay/Clientes/create')}}" class="nav-link"> <i class="fas fa-plus"></i> Agregar  </a>
                                                                    
    </li>

@endsection


@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="{{url('Munay/Clientes/create')}}"> <i class="fas fa-plus"></i> Agregar Cliente </a>  </h2> 
      
      </div>

      <div class="inside">

        {!! Form::open(['url'=>'Munay/Clientes/store']) !!}

            <div class="row">
                            
                <div class="col-md-6">
                              
                    <label for="name">Nombre:</label>

                    <div class="input-group">
                                      
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                  
                        {!!Form::text('nombre',null,['class' => 'form-control'])!!}    
                                  
                    </div>
                                      
                </div>
          
                <div class="col-md-3">
                            
                    <label for="genero"> Genero </label>

                    <div class="input-group">
                                    
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                
                      {!!Form::select('genero',['masculino' => 'Masculino','femenino' => 'Femenino','otro' => 'Otro'],0,['class' => 'form-select'])!!}    
                                
                    </div>
                                    
                </div>

                <div class="col-md-3">
                            
                    <label for="genero"> Tipo </label>

                    <div class="input-group">
                                    
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                
                      {!!Form::select('tipo',['persona' => 'Fisico','empresa' => 'Empresa'],0,['class' => 'form-select'])!!}    
                                
                    </div>
                                    
                </div>

            </div>

            <div class="row mtop16">
                            
                <div class="col-md-6">
                                          
                    <label for="name">Telefonos:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('telefonos',null,['class' => 'form-control'])!!}    
                                              
                        </div>
                                                  
                </div>

                <div class="col-md-6">
                                          
                    <label for="name">Correo Electronico:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('email',null,['class' => 'form-control'])!!}    
                                              
                        </div>
                                                  
                </div>
                        
            </div>

            <div class="row mtop16">
                            
                <div class="col-md-3">
                                          
                    <label for="name">Direccion:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('direccion',null,['class' => 'form-control'])!!} 
                            {!!Form::text('condicion',$condicion,['class' => 'form-control'])!!}    
                                              
                        </div>
                                                  
                </div>

                <div class="col-md-2">
                                          
                    <label for="name">Codigo Postal:</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('codigo_postal',null,['class' => 'form-control'])!!}    
                                              
                        </div>
                                                  
                </div>

                <div class="col-md-3">
                                          
                    <label for="name">Localidad</label>
            
                        <div class="input-group">
                                                  
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                            {!!Form::text('ciudad',null,['class' => 'form-control'])!!}    
                                              
                        </div>
                                                  
                </div>

                <div class="col-md-4">
                                          
                    <label for="name">Provincia:</label>
            
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                        {!!Form::select('provincia_id',$provincias,0,['class' => 'form-select'])!!}   
                                              
                    </div>
                                                  
                </div>
                        
            </div>

            @if(Auth::user()->tipo == "admin")

            <div class="row mtop16">
                            
                <div class="col-md-3">
                                
                    <label for="name">Factura?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                        {!!Form::select('facturacion',['Si' => 'Si','No' => 'No'],0,['class' => 'form-select'])!!}    
                                
                    </div>
                
                </div>

                <div class="col-md-3">
                                
                    <label for="name"> Cuenta Corriente?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                        {!!Form::select('cuentaCorriente',['Si' => 'Si','No' => 'No'],0,['class' => 'form-select'])!!}    
                                
                    </div>
                
                </div>       
                
                <div class="col-md-3">
                                
                    <label for="name"> Monto Dolares?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        
                        {!!Form::text('montoCuenta',null,['class' => 'form-control'])!!}       
                    
                    </div>
                
                </div>                  
                
                <div class="col-md-3">
                                
                    <label for="name"> Monto Pesos?:</label>
              
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                        
                        {!!Form::text('montoCuentaPesos',null,['class' => 'form-control'])!!}
          
                    </div>
                
                </div>  
            </div>           

            @endif  

            <div class="row mtop16">
                            
                <div class="col-md-12">
                                
                    {!!Form::submit('Guardar',['class' => 'btn btn-success']) !!}    
                                        
                </div>

            </div>

        {!! Form::close() !!}

      </div>
            
    </div>
    
</div>
    
@endsection
