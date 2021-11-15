@extends('layouts.Sinopsys')

@section('title','Agregar Producto')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/Sinopsys/Productos/Create')}}" class="nav-link"> <i class="fas fa-plus"></i> Agregar  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

  <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="{{url('/Sinopsys/Productos/Create')}}"> <i class="fas fa-plus"></i> Agregar Producto </a>  </h2> 
      
      </div>

      <div class="inside">

        {!! Form::open(['url'=>'Sinopsys/Productos/store']) !!}

            <div class="row">
                            
                <div class="col-md-6">
                              
                    <label for="name">Nombre:</label>

                    <div class="input-group">
                                      
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                  
                        {!!Form::text('nombre',null,['class' => 'form-control'])!!}    
                                  
                    </div>
                                      
                </div>

                <div class="col-md-6">
                              
                    <label for="name">Precio:</label>
            
                        <div class="input-group">
                                                
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            
                            {!!Form::number('p_local_1p',null,['class' => 'form-control'])!!}    
                                            
                        </div>
                                                
                </div>

            </div>

            <div class="row mtop16">
                            
                <div class="col-md-6">
                              
                    <label for="name">Moneda:</label>

                    <div class="input-group">
                                      
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                  
                        {!!Form::select('moneda',['Dolares' => 'Dolares','Pesos' => 'Pesos'],0,['class' => 'form-select'])!!}       
                                  
                    </div>
                                      
                </div>

                <div class="col-md-6">
                              
                    <label for="name">Categorias:</label>
            
                        <div class="input-group">
                                                
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                            
                            {!!Form::select('categoria_id',$categorias,0,['class' => 'form-select'])!!}    
                                            
                        </div>
                                                
                </div>

            </div>

            <div class="row mtop16">
                        
                  <div class="col-md-12">
      
                        <label for="name"> Descripcion</label>
      
                        <div class="input-group">
                                
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
      
                            {!!Form::textarea('descripcion',null,['class' => 'form-control'])!!}
      
                        </div>
      
                  </div>
                        
            </div>

            <div class="row mtop16">
                          
                          <div class="col-md-12">
                              
                              {!!Form::submit('Guardar',['class' => 'btn btn-success', 'onclick'=>'barra()']) !!}    
                                      
                              {!!Form::button('Cerrar',['class' => 'btn btn-danger', 'data-dismiss'=>'modal']) !!} 
                          </div>

            </div>

            <div class="row mtop16">

                  <div class="progress">
                      
                      <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        
                          <span class="sr-only">0% Complete</span>
                        
                      </div>
                  
                  </div>
                  
            </div>

        {!! Form::close() !!} 

      </div>

  </div>

</div>

@endsection