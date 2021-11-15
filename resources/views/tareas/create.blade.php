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



          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Asignar Tareas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="{{ route('tareas.store')}}" role="form">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                      <label>Usuario</label>
                      <select class="form-control select2" style="width: 100%;" id="user_id" name="user_id">
                        <option value="0">Seleccione un Usuario</option>
                        @foreach($usuarios as $usuario)
                        <option value="{{$usuario->id}}">{{$usuario->apellido}}, {{$usuario->nombre}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                      <label>Tipo de Tarea</label>
                      <select class="form-control select2" style="width: 100%;" id="tipo_tarea_id" name="tipo_tarea_id">
                        <option value="0">Seleccione un Usuario</option>
                        @foreach($tipostareas as $tipotarea)
                        <option value="{{$tipotarea->id}}">{{$tipotarea->nombre}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                      <label>Prioridad</label>
                      <select class="form-control select2" style="width: 100%;" id="prioridad" name="prioridad">
                        <option value="otro">Otro</option>
                        <option value="normal">Normal</option>
                        <option value="urgencia">Urgente</option>
                      </select>
                    </div>
                  </div>
                </div>

                

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group">
                      <label for="">Detalle</label>
                      <textarea class="form-control" rows="3" placeholder="Enter ..." id="detalle" name="detalle"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Asignar</button>
                    </div>
                  </div>
                </div>


              </form>
            </div>
            <!-- /.card-body -->
          </div>


        </div>
    </div>
</div>
@endsection
