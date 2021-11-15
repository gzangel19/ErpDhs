@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-10">
                <h4>Detalle del Pedidos</h4>
              </div>
              <div class="col-md-2">
                <a href="{{ route('compras.index') }}" class="btn btn-primary btn-block">Volver</a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <br>
                <p><b>Cliente: </b> {{ $compra->proveedor->nombre}} </p>
                <p><b>Empleado: </b> {{ $compra->user->apellido}} {{ $compra->user->nombre}} </p>
                <p><b>Numero de compra: </b>{{ $compra->num_compra }}</p>
                <p><b>Fecha y Hora: </b>{{ $compra->fecha }}</p>
                <p><b>Total Presupuestado en Pesos: </b>$ {{ $compra->total }}</p>
              </div>
            </div>

            <div class="col-md-12">
                <table class="table">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Producto</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($detalle as $det)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$det->producto->nombre }}</td>
                    <td>{{$det->cantidad }}</td>
                    <td>${{$det->precio }}</td>                 
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
@endsection
