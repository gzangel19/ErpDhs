@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
              <div class="row">
                <div class="col-md-10">
                    <h4>Listado de Historial</h4>
                  </div>
                  <div class="col-md-2">
                      <a href="{{ route('historiales.index') }}" class="btn btn-primary btn-block">Volver</a>
                </div>
              </div>
            
          </div>
          <br>
          <div class="panel-body">
            <div id="message">
             {{--  @include('flash-message') --}}
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h5>Producto: {{$productoEnServicio[0]->prod_nombre }}</h5></div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><h5>N° de Serie: {{$productoEnServicio[0]->numero_serie }}</h5></div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Fecha de creacion</th>
                  <th>Detalle</th>
                  <th> </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($historiales as $h)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td id="tdEstado">{{ $h->created_at }}</td>
                    <td>{{ $h->detalle }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>

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
