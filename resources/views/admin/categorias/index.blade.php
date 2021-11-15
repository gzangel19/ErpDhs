@extends('layouts.app')
@section('content')

<div class="container">

  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
        
        <div class="container-fluid">
          
          <div class="row mb-2">
                
            <div class="col-sm-6">

              <h1>Categorias</h1>

              @if (count($errors) > 0)
                  
                <div class="alert alert-danger card-header">
                
                  <p>Categoria No Registrada</p>
                  
                  <p>Corriga los siguientes errores:</p>
                
                  <ul>
                      @foreach ($errors->all() as $message)
                      <li>{{ $message }}</li>
                      @endforeach
                  </ul>

              </div>
            @endif 

            </div>

          </div>

        </div>

      </section>

        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                  <h3 class="card-title">Listado de Categorias</h3>
                
                  <div class="card-tools">
                        
                      <div class="input-group input-group-sm" style="width: 250px;">
                        
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                        <div class="input-group-append">

                          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        
                        </div>

                      </div>

                  </div>

              </div>

                <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                  
                  <table class="table table-hover text-nowrap">
                    
                      <thead>
                        
                        <tr>
                            <th style="text-align:center;">                                      
                              <button type="button" class="btn btn-link" data-toggle="modal" title="Agregar Categorias" data-original-title="Agregar Categoria" data-target="#ModalCliente"><i class="fas fa-plus"></i></button>
                            </th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Opciones</th>                                     
                        </tr>

                      </thead>

                      <tbody>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td style="text-align:center;">{{$loop->iteration}}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->estado }}</td>
                            <td>
                              <button type="button" class="btn btn-link" data-toggle="modal" title="Actualizar Categoria" data-original-title="Actualizar Categoria" data-target="#ModalEditarCategoria"><i class="fas fa-pencil-alt" style="color:black; font-size: 20px;"></i></button>
                              <button type="button" class="btn btn-link" data-toggle="modal" title="Eliminar Categoria" data-original-title="Actualizar Categoria" data-target="#ModalActualizarCategoria"><i class="fas fa-trash-alt" style="color:red; font-size: 20px;"></i></button>
                              <button type="button" class="btn btn-link" data-toggle="modal" title="Habilitar Categoria" data-original-title="Actualizar Categoria" data-target="#ModalActualizarCategoria"><i class="fas fa-check-circle" style="color:green; font-size: 20px;"></i></button>                           
                            </td>
                           
                          </tr>

  
  <div class="modal fade bd-example-modal-lg" id="ModalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
  <div class="modal-dialog modal-lg">
    
    <div class="modal-content">
		    
        <div class="modal-header">

        	  <h5 class="modal-title" id="titulo">Editar Categoria</h5>

     	  </div>
        
        <div class="modal-body">
	          
            <div class="card-body">

              {!! Form::open(['url' => 'categorias/store']) !!}

              <div class="row">
                  
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  
                      <label for="nombre">Nombre</label>
                      
                      <div class="input-group">

                        <div class="input-group-prepend">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                        
                        </div>
                          
                        {!! Form::text('nombre',null,['class'=>'form-control']) !!}

                      </div>

                    </div>  

              </div>
              

              <div class="row" style="margin-top: 16px;">
                  
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    
                      {!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}

                    </div>  

              </div>
                
              {!! Form::close() !!} 
                  
            </div>

        </div>

        <div class="modal-footer">
            
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        
        </div>

    </div>

  </div>

</div>

                    
                    @endforeach
                
                </tbody>

                  </table>
                  {{ $categorias->render() }}</td>
              </div>
               
            </div>
             
          </div>

        </div>

    </div>

  </div>

</div>


<!-- Modal Agregar Categorias-->

<div class="modal fade bd-example-modal-lg" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
  <div class="modal-dialog modal-lg">
    
    <div class="modal-content">
		    
        <div class="modal-header">

        	  <h5 class="modal-title" id="titulo">Agregar Categoria</h5>

     	  </div>
        
        <div class="modal-body">
	          
            <div class="card-body">

              {!! Form::open(['url' => 'categorias/store']) !!}

              <div class="row">
                  
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  
                      <label for="nombre">Nombre</label>
                      
                      <div class="input-group">

                        <div class="input-group-prepend">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>
                        
                        </div>
                          
                      {!! Form::text('nombre',null,['class'=>'form-control']) !!}

                      </div>

                    </div>  

              </div>
              

              <div class="row" style="margin-top: 16px;">
                  
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              
                        
                      {!! Form::submit('Guardar',['class'=>'btn btn-success']) !!}

                    </div>  

              </div>
                
              {!! Form::close() !!} 
                  
            </div>

        </div>

        <div class="modal-footer">
            
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        
        </div>

    </div>

  </div>

</div>

<!-- FIN Modal Agregar Categorias-->	

@endsection