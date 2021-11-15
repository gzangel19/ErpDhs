@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-10">
                <h4>Detalle del Alquiler</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <br>
                <p><b>Cliente: </b> {{ $alquiler->cliente->nombre_Fantasia }} </p>
                <p><b>Maquina: </b> {{ $alquiler->maquina->modelo }} <b> Numero Serie: </b> {{ $alquiler->maquina->numeroSerie}} </p>
                <p><b>Empleado: </b> {{ $alquiler->user->apellido}} </p>
                <p><b>Numero de alquiler: </b>{{ $alquiler->num_alquiler }}</p>
                <p><b>Fecha De Alquiler: </b>{{ $alquiler->getFromDateAttribute($alquiler->fecha) }}</p>
                <p><b>Dias Alquilado </b> {{$alquiler->calcularDias($alquiler->fecha,$alquiler->fechaBaja)}} Dias
              </div>
            </div>

            <div class="form-group">
        		
                <a class="btn btn-danger  btn-sm" href="{{ route('maquinarias.index')}}" role="button">Volver </a>

                <a class="btn btn-warning  btn-sm" href="{{ route('maquinarias.imprimirDetalleAlquiler',$alquiler->id)}}" role="button"> Imprimir </a>

                <a class="btn btn-info  btn-sm" href="#" data-toggle="modal" data-target="#exampleModal" role="button">Finalizar </a>
                
            </div>
 
            <div class="col-md-12">
                <h4>Historial Con Cliente Actual</h4>
                <table class="table">
              <thead>
                <tr>
                  <th>Tipo</th>
                  <th>Fecha</th>
                  <th>Descripcion</th>
                  <th>Contador Negro</th>
                  <th>Contador Blanco</th>
                  <th>Contador Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($historial as $his)
                    <tr>
                        <td>
                            @if($his->alquiler_id != 0)
                            Alquiler
                            @endif
                        </td>   
                      <td>{{ $his->fecha }}</td>                 
                      <td>{{ $his->descripcion }}</td>
                      <td>{{ $his->contadorNegro}}</td>
                      <td>{{ $his->contadorColor}}</td>
                      <td>{{ $his->contadorTotal}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
           
            </div>

          </div>
                 
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
      
      <div class="modal-content">
		      
          <div class="modal-header">
        	  
              <h5 class="modal-title" id="tituloUpdate">Finalizar Alquiler</h5>
     	    
          </div>
          
          <div class="modal-body">

            <div class="card-body table-responsive p-0">
            
                <form method="post" action="{{ route('maquinarias.updateAlquiler',$alquiler->id)}}" role="form">
                  
                  {{ csrf_field() }}

                  {{ method_field('PUT') }}

                  <input type="hidden" class="form-control" placeholder="Enter ..." id="pedidoid" name="pedidoid">
                  
                  <div class="row">
                      
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                        
                            <label> Contador Color </label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="contadorColor" name="contadorColor">
                                                
                        </div>
                      
                      </div>

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                        
                            <label> Contador Negro </label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="contadorNegro" name="contadorNegro">

                            <input type="text" class="form-control" placeholder="Enter ..." id="maquinaria_id" name="maquinaria_id" value="{{ $alquiler->id }}">
                                                           
                        </div>
                      
                      </div>
                                     
                  </div>
                  
                  <div class="row">
                      
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="form-group">
                        
                            <label>Descripcion</label>
                            
                            <textarea class="form-control" id="exampleFormControlTextarea1" id="descripcion" name="descripcion" rows="3"></textarea>                        
                         
                         </div>
                      
                      </div>

                  </div>


                  <div class="row">
                      
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      
                          <div class="form-group">
                          
                            <button type="submit" class="btn btn-success"> Aceptar </button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      
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

@push ('scripts')

    <script>
            function printpage(){
                window.print()
            }
    </script>

@endpush
