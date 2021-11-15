@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="col-md-12">
              <h4>Listado de Productos en Servicios</h4>
            </div>
          </div>
          <div class="panel-body">
            <div id="message">
             {{--  @include('flash-message') --}}
            </div>
            {{ Form::model(Request::only(['numero_serie']),['route' => 'historiales.index', 'method' => 'GET', 'class' => 'form-inline float-right']) }}
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar historiales" aria-label="Buscar" name="numero_serie">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            {{ Form::close() }}
            <table class="table">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Producto</th>
                  <th>Servicio</th>
                  <th>N° serie</th>
                  <th>Estado</th>
                  <th> </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($productosEnServicios as $proEnServ)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $proEnServ->prod_nombre }}</td>
                    <td>{{ $proEnServ->serv_nombre }}</td>
                    <td id="tdIdServ" style="display:none">{{$proEnServ->idServicios}}</td>
                    <td>{{ $proEnServ->numero_serie }}</td>
                    <td id="tdEstado">{{ $proEnServ->estado }}</td>
                    <td style="width: 15%">
                    <button type="button" class="btn btn-success btn-block abrirModal" id="{{$proEnServ->idProductos_en_servicios}}">Nuevo Historial</button>{{-- data-toggle="modal" data-target="#modelId" --}}
                    </td>
                    <td style="width: 15%">
                      <a href="{{ route('historiales.show', $proEnServ->idProductos_en_servicios) }}" class="btn btn-primary btn-block">Mostrar historiales</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            {{$productosEnServicios->appends(Request::only(['numero_serie']))->render()}}
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('historiales.modal')
@endsection

@section('script')
  <script type="text/javascript">
    setTimeout(function() {
      $('#message').fadeOut('fast');
    }, 2000);
  </script>
  <script>
    $(document).on('click','.abrirModal',function(e) {
      $('#idProductos_en_servicios').val($(this).prop('id'));

      var estadoActual = $(this).parent('td').siblings( "#tdEstado" ).text();
      var idServicios = $(this).parent('td').siblings( "#tdIdServ" ).text();
      $('#idServicios').val(idServicios);
      switch (estadoActual) {
        case 'alquilado':
        $("#estado").val(1).trigger('change');
          break;
        case 'libre':
          $("#estado").val(2).trigger('change');
         break;
      }
      $('#detalle').val('');

      $('#modelId').modal('show');
    });
  </script>
@endsection
