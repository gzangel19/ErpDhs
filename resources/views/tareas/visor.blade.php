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
            </div><!-- /.container-fluid -->
          </section>

          <!-- Comienza la tabla -->

          <div class="row">
            <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Tareas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>Tarea</th>
                      <th style="display:none;">Id</th>
                      <th>Descripcion</th>
                      <th style="width: 150px">Fecha de solicitud</th>
                      <th style="width: 100px">Estado</th>
                      <th style="width: 100px">Accion</th>
                      @if( Auth::user()->id == 1 || Auth::user()->id == 2 || Auth::user()->id == 3 || Auth::user()->id == 5 )
                      <th style="width: 100px">Asignar</th>
                      @endif
                      <th style="width: 100px">Comprobante</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tareas as $tarea)
                        <tr class="<?php echo ($tarea->prioridad=='urgencia')?'table-danger':'' ?>">
                        <td>{{ $tarea->tipotarea }}</td>
                        <td style="display:none;">{{ $tarea->id }}</td>
                        <td>{{ $tarea->detalle }}</td>
                        <td style="width: 150px">{{date("d/m/Y", strtotime($tarea->fecha_inicio))}}</td>
                        <td style="width: 100px">{{ ($tarea->estado == 'pendiente')? "Pendiente": "" }} {{ ($tarea->estado == 'en_proceso')? "En Proceso": "" }} {{ ($tarea->estado == 'suspendida')? "Suspendida": "" }} {{ ($tarea->estado == 'finalizada')? "Finalizada": "" }}</td>
                        @if($tarea->estado == 'pendiente' || $tarea->estado == 'en_proceso'  )
                          <td>
                            <a href="#" class="btn btn-link" data-toggle="modal" title="Ver Tarea" data-original-title="Ver Tarea" data-target="#modalMovimientoTarea" onClick="seleccionarTarea()"><i class="fas fa-arrow-right" style="color:green; font-size: 20px;"></i></a>                           
                        </td>
                        @if( Auth::user()->id == 1 || Auth::user()->id == 2 || Auth::user()->id == 3 || Auth::user()->id == 5 )
                        <td>
                            <a href="#" class="btn btn-link" data-toggle="modal" title="Ver Tarea" data-original-title="Ver Tarea" data-target="#modalAsignarTarea" onClick="asignarTarea()"><i class="fas fa-angle-double-right" style="color:green; font-size: 20px;"></i></a>
                        </td>
                        @endif
                        @if($tarea->pedido !=0)
                        <td style="width: 40px">
                          <a href="{{route('pdf.imprimirRemito',$tarea->pedido)}}"class="btn btn-link" data-toggle="tooltip" title="Imprimir Comprobante" data-original-title="Imprimir Comprobante"><i class="fas fa-print" style="color:#578DA4; font-size: 20px;"></i></a>
                        </td>
                        @else
                        <td style="width: 40px"></td>
                        @endif

                        @endif
                      </tr>
                      @endforeach
                  </tbody>
                </table>
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
          </div>

        </div>
    </div>
</div>

<!-- Modal -->
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
                            <textarea class="form-control" rows="3" id="descripcion" name="descripcion" required>{{$tarea->detalle}}</textarea>
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


<div class="modal fade" id="modalAsignarTarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Asignar Tarea</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                 <form method="post" action="{{ route('tareas.asignar')}}">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                            <label>Descripcion</label>
                            <textarea class="form-control" rows="3" id="descripcion" name="descripcion" required>{{$tarea->detalle}}</textarea>
                            <input type="hidden" name="tareas_id" id="tareas_id">
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                              <label>Usuario</label>
                              <select class="form-control select2" style="width: 100%;" id="usuario_id" name="usuario_id">
                              
                                @foreach ($usuarios as $u)
                    
                                  <option value="{{$u->id}}">{{ $u->apellido }} , {{$u->nombre}}</option>
                    
                                @endforeach
                
                              </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group">
                            <button id="guardar" class="btn btn-primary" data-toggle="tooltip" title="Registrar Presupuesto" data-original-title="Agregar Producto" type="submit">Asignar </button>
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




@endsection

@push ('scripts')

<script>

function seleccionarTarea(){
    $("table tbody tr").click(function() {
	     	var filaIdTarea = $(this).find("td:eq(1)").text();
        var filaDescripcion = $(this).find("td:eq(2)").text();
        var filaEstado = $(this).find("td:eq(4)").text();
        
        $("#tarea_id").val(filaIdTarea);
        $("#descripcion").val(filaDescripcion);
        
        $('#tipo_tarea_id').empty();
        
        var combo = document.getElementById("tipo_tarea_id");
        var option = document.createElement('option');
        var option2 = document.createElement('option');
        var option3 = document.createElement('option');
        var option4 = document.createElement('option');
        var option5 = document.createElement('option');
      // añadir el elemento option y sus valores
        combo.options.add(option, 0);
        combo.options[0].value = filaEstado.toLowerCase();
        combo.options[0].innerText = filaEstado;

        combo.options.add(option2,1);
        combo.options[1].value = "pendiente";
        combo.options[1].innerText = "Pendiente";
        
        combo.options.add(option3,2);
        combo.options[2].value = "en_proceso";
        combo.options[2].innerText = "En Proceso";

                
        combo.options.add(option4,3);
        combo.options[3].value = "suspendida";
        combo.options[3].innerText = "Suspendida";

        combo.options.add(option5,4);
        combo.options[4].value = "finalizada";
        combo.options[4].innerText = "Finalizada";
			});
}

function asignarTarea(){
    $("table tbody tr").click(function() {
	     	var filaIdTarea = $(this).find("td:eq(1)").text();
        var filaDescripcion = $(this).find("td:eq(2)").text();
        
        $("#tareas_id").val(filaIdTarea);
        $("#descripcion").val(filaDescripcion);

			});
}


</script>

@endpush