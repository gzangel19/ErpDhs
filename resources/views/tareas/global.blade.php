@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1>Tareas</h1>
              
              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                <h3 class="card-title">Listado de Tareas</h3>

                  <div class="card-tools">
                    
                      <form class="form-inline" action="{{ route('tareas.global') }}" role="form">
                                
                            <div class="input-group input-group-sm" style="width: 400px;">
                                  
                                  <select class="form-control" name="searchCondicion">
                                        <option value=""> Estado </option>
                                        <option value="todos">Todos</option>
                                        <option value="pendiente">Pendiente</option>
                                        <option value="en_proceso">En Proceso</option>
                                        <option value="suspendida">Suspendida</option>  
                                        <option value="finalizada">Finalizada</option>                    
                                  </select>
                                  
                                  <select class="form-control" style="width: 400px" id="searchText" name="searchText">
                                        <option value=""> Usuario </option>
                                        <option value="todos">Todos</option>
                                        @foreach($usuarios as $usuario)
                                        <option value="{{$usuario->id}}">{{$usuario->apellido}}, {{$usuario->nombre}}</option>
                                        @endforeach
                                  </select>
                                                                
                                  <div class="input-group-append">
                                      
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  
                                  </div>

                            </div>

                      </form>

                  </div>

              </div>

              <div class="card-body table-responsive p-0">
                
                <table class="table table-hover text-nowrap" id="datos">
                  
                  <thead>
                    
                    <tr>     
                      <th style="display:none">id</th> 
                      
                      @if (getValueJS(Auth::user()->permisosERP,'tareasCreate'))              
                      
                        <th style="text-align:center;"><a href="{{ route('tareas.create') }}" class="btn btn-link" data-toggle="tooltip" title="Nueva Tarea" data-original-title="Nueva Tarea"><i class="fas fa-plus"></i></a></th>
                      
                      @else

                      <th>Tarea</th>

                      @endif

                      <th>Fecha</th>
                      <th>Asignada</th>
                      <th>Estado</th>
                      <th></th>               
                    </tr>
                  
                  </thead>
                  
                  <tbody>
                   @foreach ($tareas as $tarea)
                        <tr class="<?php echo ($tarea->prioridad=='urgencia')?'table-danger':'' ?>">
                        <td style="display:none">{{ $tarea->id }}</td>
                        <td style="text-align:left;">{{ $tarea->tipotarea }}: {{ $tarea->detalle }}</td>
                        <td style="width: 150px">{{date("d/m/Y", strtotime($tarea->fecha_inicio))}}</td>
                        <td style="width: 150px">{{$tarea->apellido_usuario}}, {{$tarea->nombre_usuario}}</td>
                        <td style="width: 100px">{{ ($tarea->estado == 'pendiente')? "Pendiente": "" }}{{ ($tarea->estado == 'en_proceso')? "En Proceso": "" }}{{ ($tarea->estado == 'suspedida')? "Suspedida": "" }}{{ ($tarea->estado == 'finalizada')? "Finalizada": "" }}</td>                    
                        <td style="width: 50px"> 
                        
                        @if (getValueJS(Auth::user()->permisosERP,'pedidosRemito'))  
                        
                          @if($tarea->pedido !=0)

                              <a href="{{route('pdf.imprimirRemito',$tarea->pedido)}}" class="btn btn-sm btn-success btn-block" data-toggle="tooltip" title="Imprimir Comprobante" data-original-title="Imprimir Comprobante"><i class="fas fa-print" style="color:#white;"></i></a>
                          
                            @endif

                        @endif

                        @if (getValueJS(Auth::user()->permisosERP,'tareasEdit'))      
                          
                          <a href="#" class="btn-sm btn-primary btn-block" data-toggle="modal" title="Ver Tarea" data-original-title="Ver Tarea" data-target="#modalMovimientoTarea" onClick="seleccionarTarea()"><i class="fas fa-arrow-right" style="color:white;"></i></a>
                        
                        @endif  
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
                    </tr>
                  
                  </tfoot>
                
                </table>
                
                {{$tareas->render()}}
              
              </div>
            
            </div>

          </div>

          </div>

        </div>

    </div>


  <div class="modal fade" id="modalMovimientoTarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tarea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                 <form method="post" action="{{ route('tareas.movimiento')}}">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                            <label>Descripcion</label>
                            <textarea class="form-control" rows="3" id="descripcion" name="descripcion" required></textarea>
                            <input type="hidden" name="tarea_id" id="tarea_id">
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                              <label>Estado</label>
                              <select class="form-control select2" style="width: 100%;" id="tipo_tarea_id" name="tipo_tarea_id">
                              </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                            <button id="guardar" class="btn btn-primary" data-toggle="tooltip" title="Registrar Presupuesto" data-original-title="Agregar Producto" type="submit">Actualizar </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cerrar</button>
                            </div>
                        </div>
                    </div>

                </form>          
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
  </div>

</div>


@endsection

@push ('scripts')

<script>

function seleccionarTarea(){
    $("table tbody tr").click(function() {
	     	var filaIdTarea = $(this).find("td:eq(0)").text();
        var filaDescripcion = $(this).find("td:eq(1)").text();
        var filaEstado = $(this).find("td:eq(4)").text();
        
        $("#tarea_id").val(filaIdTarea);
        $("#descripcion").val(filaDescripcion);
        
        $('#tipo_tarea_id').empty();
        
        var combo = document.getElementById("tipo_tarea_id");
        var option = document.createElement('option');
        var option2 = document.createElement('option');
      // añadir el elemento option y sus valores
        combo.options.add(option,0);
        combo.options[0].value = filaEstado.toLowerCase();
        combo.options[0].innerText = filaEstado;

        combo.options.add(option2,1);
        combo.options[1].value = "Finalizada";
        combo.options[1].innerText = "Finalizada";
			});
}

</script>

@endpush