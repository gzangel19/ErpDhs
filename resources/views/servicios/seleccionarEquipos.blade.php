@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1> Servicio Tecnico </h1>
              
              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                <h3 class="card-title"> Equipos Registrados de {{ $cliente->razon_Social }} </h3>

                  <div class="card-tools">
                           
                  </div>

              </div>

              <div class="card-body table-responsive p-0">
                
              <table class="table table-hover text-nowrap" id="datos">
                    <thead>
                      <tr>
                          <th style="text-align:center;">
                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#ModalCliente" title="Agregar Cliente" data-original-title="Agregar Cliente"><i class="fas fa-plus"></i></a></button>
                          </th>
                          <th style="text-align:center">Modelo</th>
                          <th style="text-align:center">Numero</th>
                          <th style="text-align:center">Tipo</th>
                          <th style="text-align:center">Seleccione</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($equipos as $equipo)
                        <tr>
                          <td style="text-align:center">{{$loop->iteration}}</td>
                          <td style="text-align:center">{{ $equipo->modelo}}</td>  
                          <td style="text-align:center">{{ $equipo->numeroSerie}}</td>  
                          <td style="text-align:center">{{ $equipo->tipo}}</td>  
                          <td style="text-align:center">
                          <a href="{{ route('servicios.create',['cliente' => $cliente->id, 'maquina' => $equipo->id]) }}"  class="btn btn-success" data-toggle="tooltip" title="Seleccionar" data-original-title="Seleccionar"><i class="fas fa-check"></i></a>                         
                        </td>

                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                
                {{$equipos->render()}}
              
              </div>
            
            </div>

          </div>

          </div>

        </div>

    </div>

</div>


<!-- Modal Agregar Cede-->

<div class="modal fade bd-example-modal-lg" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">
      
      <div class="modal-content">
		      
          <div class="modal-header">
        	  <h5 class="modal-title" id="titulo">Agregar Maquina</h5>		
     	    </div>
          
          <div class="modal-body">
	          
            <div class="card-body">
              
              <form method="post" action="{{ route('servicios.maquinarias')}}" role="form">
                {{ csrf_field() }}
                
                <div class="row">
                
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                          
                          <label>Modelo</label>
                          <input type="text" class="form-control" placeholder="Enter ..." id="modelo" name="modelo" required>
                          <input type="hidden" class="form-control" placeholder="Enter ..." id="cliente_id" name="cliente_id" value="{{$cliente->id}}">
                        
                        </div>

                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                        
                            <label> Numero de Serie </label>
                              
                            <input type="text" class="form-control" placeholder="Enter ..." id="numeroSerie" name="numeroSerie" required>
                    
                        </div>
  
                    </div>
                  
                </div>

                <div class="row">
                                  
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                    
                          <label>Tipo</label>
                            
                          <select class="form-control select2" style="width: 100%;" id="tipo" name="tipo">
                            <option value="Color">Color</option>
                            <option value="Blanco/Negro">Blanco/Negro</option>
                          </select>
                
                        </div>
                    
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                    
                          <label> Condicion </label>
                            
                          <select class="form-control select2" style="width: 100%;" id="condicion" name="condicion">
                            <option value="Propia"> Propia </option>
                            <option value="Del Cliente"> Del Cliente </option>
                          </select>
                
                        </div>
                    
                    </div>

                </div>

                <div class="row">
            
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                        
                            <label> Ubicacion </label>
                              
                            <input type="text" class="form-control" placeholder="Enter ..." id="ubicacion" name="ubicacion">
                    
                        </div>

                    </div>
              
                </div>
                

                <div class="row">
                  
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    
                      <div class="form-group">
                          
                          <button type="submit" class="btn btn-primary">Agregar</button>

                          <button type="submit" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                      </div>
                    
                    </div>

                </div>


              </form>  
                  
            </div>

          </div>


      </div>

    </div>

</div>

@endsection