@extends('layouts.app')

@section('title','Editar Unidad de Negocio')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/unidades')}}" class="nav-link"> <i class="fas fa-address-card"></i> Unidad de Negocios  </a>
                                    
    </li>

    <li class="breadcrumb-item">
                                        
        <a href="{{url('unidades/editar/'.$unidad->id)}}" class="nav-link"> <i class="fas fa-edit"></i> Editar  </a>
                                                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

  <div class="row">
            
    <div class="col-md-8">

      <div class="panel shadow">
        
          <div class="header">
              
              <h2 class="title"> <a href="{{url('/unidades/editar/'.$unidad->id)}}"> <i class="fas fa-edit"></i> Editar Unidad De Negocio </a>  </h2> 
          
          </div>
          
          <div class="inside">

            {!! Form::open(['url'=>'unidades/update/'.$unidad->id,'files' => true]) !!}

                <div class="row">
                                
                    <div class="col-md-6">
                                  
                        <label for="name">Nombre:</label>

                        <div class="input-group">
                                          
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                      
                            {!!Form::text('nombre',$unidad->nombre,['class' => 'form-control'])!!}    
                                      
                        </div>
                                          
                    </div>

                    <div class="col-md-6">
                                  
                        <label for="name">Logo:</label>

                        <div class="input-group">
                                          
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-image"></i></span>
                                      
                            {!!Form::file('img',['class' => 'form-control','id'=>'customFile', 'accept' => 'image/*'])!!}   
                                      
                        </div>
                                          
                    </div>

                </div>

                <div class="row mtop16">
                                
                    <div class="col-md-6">
                                              
                        <label for="name">Cuit:</label>
                
                            <div class="input-group">
                                                      
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                                {!!Form::text('cuit',$unidad->cuit,['class' => 'form-control'])!!}    
                                                  
                            </div>
                                                      
                    </div>

                    <div class="col-md-6">
                                              
                        <label for="name">Telefono:</label>
                
                            <div class="input-group">
                                                      
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                                {!!Form::text('telefonos',$unidad->telefonos,['class' => 'form-control'])!!}    
                                                  
                            </div>
                                                      
                    </div>
                            
                </div>

                <div class="row mtop16">
                                
                    <div class="col-md-6">
                                              
                        <label for="name">Direccion:</label>
                
                            <div class="input-group">
                                                      
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                                {!!Form::text('direccion',$unidad->direccion,['class' => 'form-control'])!!}    
                                                  
                            </div>
                                                      
                    </div>

                    <div class="col-md-6">
                                              
                        <label for="name">Codigo Postal:</label>
                
                            <div class="input-group">
                                                      
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                                {!!Form::text('codigo_postal',$unidad->codigo_postal,['class' => 'form-control'])!!}    
                                                  
                            </div>
                                                      
                    </div>
                  
                </div>

                <div class="row mtop16">

                    <div class="col-md-6">
                                              
                        <label for="name">Localidad</label>
                
                            <div class="input-group">
                                                      
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                                {!!Form::text('ciudad',$unidad->ciudad,['class' => 'form-control'])!!}    
                                                  
                            </div>
                                                      
                    </div>

                    <div class="col-md-6">
                                              
                        <label for="name">Provincia:</label>
                
                        <div class="input-group">
                                                      
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                                  
                            {!!Form::select('provincia_id',$provincias,$unidad->provincia_id,['class' => 'form-select'])!!}   
                                                  
                        </div>
                                                      
                    </div>
                            
                </div> 

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