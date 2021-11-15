@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12">
              <h4>Listado de Cedes</h4>
            </div>
          </div>
          <div class="panel-body">
            <div id="message">
             {{--  @include('flash-message') --}}
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Nombre</th>
                  <th>Domicilio</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                  <th style="width: 15%">
                    <a href="{{ route('cede.create') }}" class="btn btn-primary btn-block">Agregar</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cedes as $cede)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $cede->nombre }}</td>
                    <td>{{ $cede->domicilio }}</td>
                    <td style="width: 15%">
                      <a href="{{ route('cede.show', $cede->idCedes) }}" class="btn btn-success btn-block">Mostrar</a>
                    </td>
                    <td style="width: 15%">
                      <a href="{{ route('cede.edit', $cede->idCedes) }}" class="btn btn-warning btn-block">Editar</a>
                    </td>
                    <td style="width: 15%">
                      <form class="" action="{{ route('cede.destroy', $cede->idCedes)}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" onclick="return confirm('Esta acción no podrá deshacerse. ¿Continuar?')" class="btn btn-danger btn-block">Eliminar</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{$cedes->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script type="text/javascript">
    setTimeout(function() {
      $('#message').fadeOut('fast');
    }, 2000);
  </script>
@endsection