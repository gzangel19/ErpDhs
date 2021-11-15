@extends('layouts.app')

@section('title','Ver Unidad de Negocio')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/unidades')}}" class="nav-link"> <i class="fas fa-address-card"></i> Unidad de Negocios  </a>
                                    
    </li>

    <li class="breadcrumb-item">
                                        
        <a href="{{url('unidades/detalle/'.$unidad->id)}}" class="nav-link"> <i class="far fa-eye"></i> Datos Unidad de Negocio  </a>
                                                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

  <div class="row">
            
    <div class="col-md-8">

      <div class="panel shadow">
        
          <div class="header">
              
              <h2 class="title"> <a href="{{url('/unidades/detalle/'.$unidad->id)}}"> <i class="far fa-eye"></i> Datos Unidad De Negocio </a>  </h2> 
          
          </div>
          
          <div class="inside">

            {!! Form::open(['url'=>'unidades/update/'.$unidad->id,'files' => true]) !!}

                <div class="row">
                                
                    <div class="col-md-12">
                                  
                        <label for="name">Nombre:</label>

                        <div class="input-group">
                                          
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                      
                            {!!Form::text('nombre',$unidad->nombre,['class' => 'form-control','readonly'=>'true'])!!}    
                                      
                        </div>
                                          
                    </div>

                </div>

                <div class="row mtop16">
                                
                    <div class="col-md-6">
                                              
                        <label for="name">Cuit:</label>
                
                            <div class="input-group">
                                                      
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                                {!!Form::text('cuit',$unidad->cuit,['class' => 'form-control','readonly'=>'true'])!!}    
                                                  
                            </div>
                                                      
                    </div>

                    <div class="col-md-6">
                                              
                        <label for="name">Telefono:</label>
                
                            <div class="input-group">
                                                      
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                                {!!Form::text('telefonos',$unidad->telefonos,['class' => 'form-control','readonly'=>'true'])!!}    
                                                  
                            </div>
                                                      
                    </div>
                            
                </div>

                <div class="row mtop16">
                                
                    <div class="col-md-6">
                                              
                        <label for="name">Direccion:</label>
                
                            <div class="input-group">
                                                      
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                                {!!Form::text('direccion',$unidad->direccion,['class' => 'form-control','readonly'=>'true'])!!}    
                                                  
                            </div>
                                                      
                    </div>

                    <div class="col-md-6">
                                              
                        <label for="name">Codigo Postal:</label>
                
                            <div class="input-group">
                                                      
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                                {!!Form::text('codigo_postal',$unidad->codigo_postal,['class' => 'form-control','readonly'=>'true'])!!}    
                                                  
                            </div>
                                                      
                    </div>
                  
                </div>

                <div class="row mtop16">

                    <div class="col-md-6">
                                              
                        <label for="name">Localidad</label>
                
                            <div class="input-group">
                                                      
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                                {!!Form::text('ciudad',$unidad->ciudad,['class' => 'form-control','readonly'=>'true'])!!}    
                                                  
                            </div>
                                                      
                    </div>

                    <div class="col-md-6">
                                              
                        <label for="name">Provincia:</label>
                
                        <div class="input-group">
                                                      
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                            {!!Form::text('provincia',$unidad->provincia->nombre,['class' => 'form-control','readonly'=>'true'])!!}
                                                  
                        </div>
                                                      
                    </div>
                            
                </div> 

                <div class="opts mtop16">

                  <a class="delete" href="{{ url('/unidades') }}" title="Volver"> <i class="fas fa-arrow-left"></i> </a>

                  <a class="edit" href="{{ url('unidades/editar/'.$unidad->id) }}" title="Editar Unidad de Negocio"> <i class="fas fa-edit"></i> </a>                           
                            
                </div>

            {!! Form::close() !!}

          </div>
        
      </div>
      
    </div>

    <div class="col-md-4">

      <div class="panel shadow">

          <div class="header">
          
              <h2 class="title"> <a href=""> <i class="fas fa-camera"></i> Logo  </a>  </h2> 

              <div class="inside">
                  
                  <a  data-fancybox="gallery" href="{{ url('img/unidades/'.$unidad->imagen) }}">
                  
                      <img src=" {{ url('img/unidades/'.$unidad->imagen) }}" class="img-fluid"> 
              
                  </a>

              </div>
          
          </div>

      </div>

    </div>
    
  </div>

</div>

@endsection