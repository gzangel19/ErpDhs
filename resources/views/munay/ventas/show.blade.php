@extends('layouts.munay')
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
                <p><b> Numero de Pedido: </b>{{ $pedido->num_pedido }} </p>
                <p><b> Cliente: </b> {{ $pedido->cliente->nombre_Fantasia }} <b> Empleado: </b> {{ $pedido->user->apellido}} , {{ $pedido->user->nombre}} </p>
                <p><b> Fecha y Hora: </b> {{ $pedido->getFromDateAttribute( $pedido->fecha)  }}</p>
                <p><b> Estado de Entrega : </b>{{ $pedido->estado }} <b> Estado de Pago : </b>{{ $pedido->pago }}</p>
                <p><b> Deposito: </b>{{ $pedido->deposito->nombre }} <b> Tipo de Entrega: </b>{{ $pedido->tipo_entrega }} </p>
                <p><b> Forma de Pago: </b>{{ $pedido->modo_venta }} </p>
              </div>
            </div>
            <br>
            
            <div class="form-group">           
                                
                  <a href="{{route('pdf.imprimirRemito', $pedido->id)}}"class="btn btn-primary  btn-sm" data-toggle="tooltip" title="Imprimir Comprobante" data-original-title="Imprimir Comprobante">Imprimir</a>                        

                      @if(Auth::user()->tipo != 'vendedor')
                          <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Modificar</button>
                      @endif
                  
            </div>
            <br>
            <div class="col-md-12">
                <h5>Detalle</h5>
              <table class="table">
              <thead>
                <tr>
                  <th style="text-align:center;">Nombre</th>
                  <th style="text-align:center;">Cantidad</th>
                  <th style="text-align:center;">Precio</th>
                  <th style="text-align:center;">Descuento</th>
                  <th style="text-align:center;">Sub Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($detalle as $det)
                  <tr border="1">
                    <td style="text-align:center;"> {{$det->producto->nombre }}</td>
                    <td style="text-align:center;"> {{$det->cantidad }}</td>
                    <td style="text-align:center;"> AR$ {{ round( $det->precio,0 )}} </td>
                    <td style="text-align:center;"> {{ $det->descuento }} % </td>
                    <td style="text-align:center;"> AR$  {{ round( ($det->precio  * $det->cantidad) - ( ($det->precio  * $det->cantidad) * ($det->descuento/100) ),0 ) }} </td>
                  </tr>
                @endforeach
                @if($pedido->modo_venta == 'Ahora6')
                  <tr border="1">
                    <td style="text-align:center;"> Financiacion Ahora 6 </td>
                    <td style="text-align:center;"> 1 </td>
                    <td style="text-align:center;"> AR$ {{ round( ( $suma * 0.08 ),0 ) }} </td>
                    <td style="text-align:center;"> - </td>
                    <td style="text-align:center;"> AR$  {{ round( $suma * 0.08,0 ) }} </td>
                  </tr>
                @endif
                @if($pedido->modo_venta == 'Ahora12')
                  <tr border="1">
                    <td style="text-align:center;"> Financiacion Ahora 12 </td>
                    <td style="text-align:center;"> 1 </td>
                    <td style="text-align:center;"> AR$ {{ round( $suma * 0.15,0 ) }} </td>
                    <td style="text-align:center;"> - </td>
                    <td style="text-align:center;"> AR$  {{ round(  $suma * 0.15,0 ) }} </td>
                  </tr>
                @endif
                @if($pedido->modo_venta == 'Ahora18')
                  <tr border="1">
                    <td style="text-align:center;"> Financiacion Ahora 18 </td>
                    <td style="text-align:center;"> 1 </td>
                    <td style="text-align:center;"> AR$ {{ round( $suma * 0.20,0 ) }} </td>
                    <td style="text-align:center;"> - </td>
                    <td style="text-align:center;"> AR$  {{ round( $suma * 0.20,0 ) }} </td>
                  </tr>
                @endif

              </tbody>
              <tfooter>
                  <tr>
                    <th style="text-align:center;"></th>
                    <th style="text-align:center;"></th>
                    <th style="text-align:center;"></th>
                    <th style="text-align:center;">Total</th>
                    
                    <th style="text-align:center;"> AR$  {{ round( round( $pedido->total,2 ),0) }}  </th>
                  </tr>
              </tfooter>
            </table>

            
           
            </div>

          </div>
                           
        </div>
      </div>
    </div>
  </div>

    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    
      <div class="modal-dialog modal-sm">
      
            <div class="modal-content">

              <div class="card-header">
                
                <h3 class="card-title"> Modificar Venta </h3>

                <br>

                <h3 class="card-title"> Nº {{$pedido->num_pedido}} </h3>
            
              </div>

              <div class="card-body">
            
                <form method="post" action="{{ route('pedidos.update',$pedido->id)}}" role="form">
                      
                      {{ csrf_field() }}

                      @method('PUT')
                      
                        <div class="row">
                          
                          <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                              
                              <div class="form-group">
                                  
                                  <label>Estado</label>
                                    
                                  <select class="form-control select2" style="width: 100%;" id="estado" name="estado">
                                    <option value="{{$pedido->estado}}">{{$pedido->estado}}</option>  
                                    <option value="Preparando">Preparando</option>
                                    <option value="Entregado">Entregado</option>
                                  </select>
                              
                              </div>
                          
                          </div>
                        
                        </div>
                        
                        <div class="row">
        
                          <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                              
                              <div class="form-group">
                                  
                                  <label>Forma de Pago</label>
                                    
                                  <select class="form-control select2" style="width: 100%;" id="modoPago" name="modoPago" >
                                    <option value="{{$pedido->modo_venta}}">{{$pedido->modo_venta}}</option>    
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="Mercado Pago">Mercado Pago</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                  </select>
                              
                              </div>
                          
                          </div>
                        
                        </div>

                        <div class="row">
        
                          <div class="col-xs-24 col-sm-24 col-md-12 col-lg-12 col-xl-12">
                              
                              <div class="form-group">
                                  
                                  <label> Sucursal </label>
                                    
                                  <select class="form-control select2" style="width: 100%;" id="deposito_id" name="deposito_id" >
                                    <option value="{{$pedido->deposito->id}}">{{$pedido->deposito->nombre}}</option>
                                    @foreach($depositos as $deposito)
                                      <option value="{{$deposito->id}}">{{$deposito->nombre}}</option>
                                    @endforeach
                                  </select>
                              
                              </div>
                          
                          </div>
                        
                        </div>
        
                        <div class="row">
                          
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            
                            <div class="form-group">
                              
                              <button type="submit" class="btn btn-primary btn-sm"> Modificar  </button>
        
                              <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
                            
                            </div>
                          
                          </div>
                        
                        </div>
        
                </form>

              </div>

          </div>
        
        </div>
    
      </div>
    
    </div>

@endsection
