@extends('layouts.app')

@section('title','Editar Deposito')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/depositos')}}" class="nav-link"> <i class="fas fa-warehouse"></i> Deposito  </a>
                                    
    </li>

    <li class="breadcrumb-item">
                                        
        <a href="#" class="nav-link"> <i class="fas fa-edit"></i> Editar  </a>
                                                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="#"> <i class="fas fa-edit"></i> Editar </a>  </h2> 
      
      </div>

      <div class="inside">

        {!! Form::open(['url'=>'depositos/update/'.$deposito->id]) !!}

            <div class="row">
                            
                <div class="col-md-6">
                                          
                    <label for="name">Nombre:</label>
            
                    <div class="input-group">
                                                  
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                              
                        {!!Form::text('nombre',$deposito->nombre,['class' => 'form-control'])!!}    
                                              
                    </div>
                                                  
                </div>

                <div class="col-md-6">
                                          
                    <label for="name">Telefono:</label>
                                  
                    <div class="input-group">
                                                                        
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                                                    
                        {!!Form::text('telefonos',$deposito->telefonos,['class' => 'form-control'])!!}    
                                                                    
                    </div>
                                                                        
                </div>
            
            </div>

            <div class="row mtop16">
                            
                <div class="col-md-6">
                                                      
                      <label for="name">Direccion:</label>
                          
                      <div class="input-group">
                                                                
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                            
                          {!!Form::text('direccion',$deposito->direccion,['class' => 'form-control'])!!}    
                                                            
                      </div>
                                                              
                </div>
            
                <div class="col-md-6">
                                                      
                      <label for="name">Ciudad:</label>
                                              
                      <div class="input-group">
                                                                                    
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-city"></i></span>
                                                                                
                          {!!Form::text('ciudad',$deposito->ciudad,['class' => 'form-control'])!!}    
                                                                                
                      </div>
                                                                                    
                </div>
                        
            </div>

            <div class="row mtop16">
                            
                <div class="col-md-6">
                                                      
                      <label for="name">Codigo Postal:</label>
                          
                      <div class="input-group">
                                                                
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                            
                          {!!Form::text('codigo_postal',$deposito->codigo_postal,['class' => 'form-control'])!!}    
                                                            
                      </div>
                                                              
                </div>
            
                <div class="col-md-6">
                                                      
                      <label for="name">Provincia:</label>
                                              
                      <div class="input-group">
                                                                                    
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-city"></i></span>
                                                                                
                          {!!Form::select('provincia_id',$provincias,$deposito->provincia_id,['class' => 'form-select'])!!} 
                                                                                
                      </div>
                                                                                    
                </div>
                        
            </div>

            <div class="row mtop16">
                            
                <div class="col-md-12">
                                            
                    {!!Form::submit('Actualizar',['class' => 'btn btn-success']) !!}    
                                                    
                    {!!Form::reset('Cancelar',['class' => 'btn btn-danger']) !!} 
                            
                </div>
            
            </div>
            
        {!! Form::close() !!}

      </div>

    </div>

</div>

@endsection
