@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
            
        <div class="container-fluid">
              
          <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1> Maquinarias </h1>
              
              </div>

          </div>
        
        </div>
      
      </section>
      
        <div class="row">
        
          <div class="col-12">
              
              <div class="card">
                
                <div class="card-header">
                  
                  <h3 class="card-title"> Listado de Maquinas </h3>

                    <div class="card-tools">
                        
                              <form class="form-inline" action="{{ route('maquinarias.index') }}" role="form">
                                
                                <div class="input-group input-group-sm" style="width: 300px;">
                                  
                                  <select class="form-control" name="searchCondicion">
                                    <option value="razon_Social">Cliente</option>  
                                    <option value="numero">Nº Serie</option>               
                                  </select>
                                  
                                  <input type="text" name="searchText" class="form-control float-right" placeholder="Buscar">
                                                                
                                  <div class="input-group-append">
                                      
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  
                                  </div>

                                </div>

                              </form>

                    </div>

                </div>
                
                <div class="card-body table-responsive p-0">
                    
                    <table class="table table-hover text-nowrap">
                        
                        <thead>
                          <tr>
                              <th style="text-align:center;">                     
                                <a href="{{ route('maquinarias.create') }}" class="btn btn-link" data-toggle="tooltip" title="Agregar Maquinaria" data-original-title="Agregar Maquinaria"><i class="fas fa-plus"></i></a>                                                 
                              </th>
                              <th style="text-align:center;"> Marca </th>
                              <th style="text-align:center;"> Numero de Serie </th>
                              <th style="text-align:center;"> Cliente Actual</th>
                              <th style="text-align:center;"> Estado </th>
                              <th style="text-align:center;"> Opciones </th>
                              
                          </tr>

                        </thead>
                        
                        <tbody>
                          @foreach ($maquinarias as $maquinaria)
                          <tr>
                              <td style="text-align:center;">{{$loop->iteration}}</td>
                              <td style="text-align:center;">{{ $maquinaria->modelo }}</td>
                              <td style="text-align:center;">{{ $maquinaria->numeroSerie }}</td> 
                              @if($maquinaria->cliente_id == 0)
                              <td style="text-align:center;">Sin Cliente</td>
                              @else
                              <td style="text-align:center;">{{ $maquinaria->clientes->razon_Social }}</td>
                              @endif
                              <td style="text-align:center;">{{ $maquinaria->estado }}</td>                      
                              <td style="text-align:center;">
                                <a href="{{ route('clientes.edit', $maquinaria->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" title="Historial" data-original-title="Historial">Historial</a>
                                @if($maquinaria->estado == "Alquilado")
                                <a href="{{ route('maquinarias.finalizarAlquiler', $maquinaria->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Historial" data-original-title="Historial">Finalizar</a>
                                @else
                                <a href="{{ route('maquinarias.AlquilerVenta', $maquinaria->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Historial" data-original-title="Historial">Alquilar</a>
                                @endif
                                <a href="{{ route('clientes.edit', $maquinaria->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Historial" data-original-title="Historial">Servicio</a>
                              </td>
                          </tr>
                          @endforeach
                        
                        </tbody>

                        <tfoot>

                          <tr>
                              <th</th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                          </tr>

                        </tfoot>
                    
                    </table>
                    
                    {{$maquinarias->render()}}

                </div>

              </div>

          </div>

        </div>

    </div>

  </div>

</div>

@endsection
