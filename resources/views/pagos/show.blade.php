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
            </div>
            <div class="row">
              <div class="col-md-12">
                <br>
                <p><b>Cliente: </b> {{ $pedido->cliente->nombre_Fantasia }} </p>
                <p><b>Empleado: </b> {{ $pedido->user->apellido}} {{ $pedido->user->nombre}} </p>
                <p><b>Numero de Pedido: </b>{{ $pedido->num_pedido }}</p>
                <p><b>Fecha y Hora: </b>{{ $pedido->fecha }}</p>
                <p><b>Total Pedido: </b>{{ $pedido->total }} AR$</p>
                <p><b>Estado: </b>{{ $pedido->estado }}</p>
                <p><b>Tipo de Entrega: </b>{{ $pedido->tipo_entrega }} {{ $pedido->deposito->nombre}}</p>
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
                  <th>Estado</th>
                  <th>Deposito</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($detalle as $det)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$det->producto->nombre }}</td>
                    <td>{{$det->cantidad }}</td>
                    <td> AR$ {{$det->precio  }} </td>
                    <td>AR$ {{$det->precio  * $det->cantidad }}</td>
                    <td>{{$det->estado}}</td>
                    <td>{{$det->deposito->nombre}}</td>

                    @if($det->deposito->id == $pedido->deposito->id )

                        @if($det->estado == 'Pendiente' )
                        <td>
                          <form class="" action="{{ route('pedidos.preparar',['id' => $det->id, 'pedido' => $pedido->id])}}">
                            <button type="submit" onclick="return confirm('Esta acción no podrá deshacerse. ¿Cambiar estado al pedido?')" class="btn btn-link" data-toggle="tooltip" title="Cambiar Estado" data-original-title="Reporte PDF"><i class="fas fa-reply-all" style="color:red"></i></button>
                          </form>
                        </td>
                        @else
                        <td>
                        <a href="#" class="btn btn-link" data-toggle="tooltip" title="Producto Preparado" data-original-title="Reporte PDF"><i class="fas fa-check" style="color:green; font-size: 20px;"></i></a>
                        </td>
                        @endif
                    @endif
                  </tr>
                @endforeach
              </tbody>
            </table>

            <div class="form-group">
        		
                <a class="btn btn-danger" href="{{ route('pedidos.index')}}" role="button">Volver <i class="fas fa-arrow-alt-circle-left" style="color:#E8EE10"></i></a>
        
            </div>
           
            </div>

          </div>
                 
        </div>
      </div>
    </div>
  </div>
@endsection
