@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-10">
                <h4>Detalle del Movimiento de Productos entre depositos</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <br>
                <p><b>Deposito de Origen: </b> {{$movimiento->depositoOrigen->nombre}} </p>
                <p><b>Deposito de Destino:</b> {{$movimiento->depositoDestino->nombre}}</p>
              </div>
            </div>

            <div class="col-md-12">
                <h4>Seguimiento del Movimiento</h4>
                <table class="table">
              <thead>
                <tr>
                  <th style="text-align:center;">#</th>
                  <th style="text-align:center;">Producto</th>
                  <th style="text-align:center;">Cantidad</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($detalle as $det)
                  <tr>
                    <td style="text-align:center;">{{$loop->iteration}}</td>
                    <td style="text-align:center;">{{$det->producto->nombre}}</td>
                    <td style="text-align:center;">{{$det->cantidad }}</td>
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
