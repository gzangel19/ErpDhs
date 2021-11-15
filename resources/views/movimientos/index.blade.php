@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
            
        <div class="container-fluid">
              
          <div class="row mb-2">
              
              <div class="col-sm-6">
              
              </div>

          </div>
        
        </div>
      
      </section>
      
        <div class="row">
        
          <div class="col-12">
              
              <div class="card card-primary">
                
                <div class="card-header">
                  
                    <h3 class="card-title"> Historial de Movimientos </h3>

                    <div class="card-tools">
                        
                        <div class="input-group input-group-sm" style="width: 250px;">
                            
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                              <div class="input-group-append">
                                
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                              
                              </div>
                        </div>

                    </div>

                </div>
                
                <div class="card-body table-responsive p-0">
                    
                    <table class="table table-hover text-nowrap">
                        
                        <thead>

                          <tr>
                              <th>Fecha</th>
                              <th>Deposito Salida</th>
                              <th>Deposito Destino</th>
                              <th>Detalle</th>
                          </tr>

                        </thead>
                        
                        <tbody>
                          @foreach ($movimientos as $movimiento)
                          <tr>
                              <td>{{$movimiento->fecha }} </td>
                              <td>{{$movimiento->depositoOrigen->nombre}}</td>
                              <td>{{$movimiento->depositoDestino->nombre  }}</td>
                              <td>
                                <a href="{{ route('movimientos.show', $movimiento->id) }}" class="btn btn-link" data-toggle="tooltip" title="Ver Detalle Cliente" data-original-title="Ver Detalle Cliente"><i class="far fa-eye" style="color:green; font-size: 20px;"></i></a>
                              </td>
                          </tr>
                          @endforeach
                        
                        </tbody>

                    </table>
                    
                    {{$movimientos->render()}}

                </div>

              </div>

          </div>

        </div>

    </div>

  </div>

</div>

@endsection
