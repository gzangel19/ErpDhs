@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-10">
                <h4>Presupuesto</h4>
              </div>
              <div class="col-md-2">
                <a href="{{ route('presupuestos.index') }}" class="btn btn-primary btn-block">Volver</a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <br>
                <p><b>Cliente: </b> {{ $presupuesto->proveedor->nombre }} </p>
                <p><b>Empleado: </b> {{ $presupuesto->user->apellido}} {{ $presupuesto->user->nombre}} </p>
                <p><b>Numero de Comprobante: </b>{{ $presupuesto->num_comprobante }}</p>
                <p><b>Fecha: </b>{{ $presupuesto->fecha }}</p>
                <p><b>Total: </b>$ {{ $presupuesto->total }}</p>
                <p><b>Estado: </b>{{ $presupuesto->estado }}</p>
              </div>
            </div>

            <div class="col-md-12">
                <h4>Productos</h4>
                <table class="table">
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Sub Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($detalle as $det)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$det->producto->nombre }}</td>
                    <td>{{$det->cantidad }}</td>
                    <td>${{$det->precio }}</td>
                    <td>${{$det->precio  * $det->cantidad }}</td>
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
  </div>
@endsection
