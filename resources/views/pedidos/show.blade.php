@extends('layouts.app')

@section('title','Detalle Venta')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('Pedidos/Detalle/'.$pedido->id)}}" class="nav-link"> <i class="fas fa-cash-register"></i> Detalle Venta   </a>
                                    
    </li>

@endsection

@section('content')


<div class="container-fluid">

    <div class="panel shadow">

        <div class="row mtop16">

            <div class="col-md-4">
    
                <div class="inside">

                    <div class="header">
                        
                          <h2 class="title"> <a href="{{url('Pedidos/Detalle/'.$pedido->id)}}"> <i class="fas fa-cash-register"></i> Datos de la Venta </a>  </h2> 
                    
                    </div>

                    <div class="info">

                          <span class="title"> <i class="fas fa-sort-numeric-up-alt"></i> N° Venta: </span>

                          <span> {{ $pedido->num_pedido }}</span>

                          <span class="title"> <i class="fas fa-id-card"></i> Cliente: </span>

                          <span> {{ $pedido->cliente->razon_Social }} </span>

                          <span class="title"> <i class="fas fa-user-tie"></i> Vendedor: </span>

                          <span> {{ $pedido->user->apellido}} , {{ $pedido->user->nombre}}  </span>

                          <span class="title"> <i class="fas fa-coins"></i> Estado de Pago: </span>

                          <span> {{ $pedido->pago }}  </span>

                          <span class="title"> <i class="far fa-calendar-alt"></i> Estado de Entrega: </span>

                          <span> {{ $pedido->estado }}  </span>

                          <span class="title"> <i class="far fa-calendar-alt"></i> Fecha y Hora: </span>

                          <span> {{ $pedido->getFromDateAttribute( $pedido->fecha) }}  </span>

                          <span class="title"> <i class="fas fa-home"></i> Deposito: </span>

                          <span> {{ $pedido->deposito->nombre }}  </span>

                          <span class="title"> <i class="fas fa-money-check-alt"></i> Total Venta: </span>

                          <span> AR$ {{ number_format( round( $pedido->total ) , 2 , ',' , '.') }} </span>

                          <span class="title"> <i class="fas fa-money-check-alt"></i> Saldo a Pagar: </span>
              
                          @if($pedido->pago != 'Pagado')

                            <span> AR$ {{ number_format( round( ( $pedido->deuda_pesos +   ($pedido->deuda_dolares * $dolar->valor) - $pedido->pago_parcial ) ) , 2 , ',' , '.') }} </span>
                          
                          @else
                          
                            <span> AR$ 0 </span>
                
                          @endif

                          <a href="{{url('/Pedidos/Index/')}}" class="btn btn-success mtop16">Volver</a> 
                          
                          @if (getValueJS(Auth::user()->permisosERP,'pedidosEdit'))
                          
                              <a href="#" class="btn btn-primary mtop16" data-toggle="modal" data-target=".bd-example-modal-sm">Modificar</a>
                          
                          @endif

                          @if (getValueJS(Auth::user()->permisosERP,'pedidosDelete'))
                          
                              <a href="{{url('pedido/eliminar/'.$pedido->id)}}" class="btn btn-danger mtop16">Eliminar</a>
                              
                          @endif

                    </div>

                </div>

            </div>

            <div class="col-md-8">
    
                <div class="inside">

                    <div class="header">
                        
                          <h2 class="title"> <a href="{{url('Pedidos/Detalle/'.$pedido->id)}}"> <i class="fas fa-clipboard-list"></i> Listado de Productos </a>  </h2> 
                    
                    </div>

                    <table class="table table-hover mtop16">
                                    
                      <thead>
                                            
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Descuento</th>
                                <th>Sub Total</th>
                                            
                            </tr>
            
                      </thead>
                                                
                      <tbody>
                              @foreach ($detalle as $det)
                                <tr>
                                  <td width="64px">
                                      <a  data-fancybox="gallery" href="{{ url('img/productos/'.$det->producto->img) }}"> 
                                      <img src=" {{ url('img/productos/'.$det->producto->img) }}" width="64px" > 
                                      </a>
                                  </td>
                                  <td> {{$det->producto->nombre }}</td>
                                  <td width="5px"> {{$det->cantidad }}</td>
                                  <td> AR$ {{ round( $det->precio,0 )}} </td>
                                  <td> {{ $det->descuento }} % </td>
                                  <td> AR$  {{ round( ($det->precio  * $det->cantidad) - ( ($det->precio  * $det->cantidad) * ($det->descuento/100) ),0 ) }} </td>
                                </tr>
                              @endforeach
                              @if($pedido->modo_venta == 'Ahora6')
                                <tr>
                                  <td></td>
                                  <td> Financiacion Ahora 6 </td>
                                  <td> 1 </td>
                                  <td> AR$ {{ round( ( $suma * 0.08 ),0 ) }} </td>
                                  <td> - </td>
                                  <td> AR$  {{ round( $suma * 0.08,0 ) }} </td>
                                </tr>
                              @endif
                              @if($pedido->modo_venta == 'Ahora12')
                                <tr>
                                  <td></td>
                                  <td> Financiacion Ahora 12 </td>
                                  <td> 1 </td>
                                  <td> AR$ {{ round( $suma * 0.15,0 ) }} </td>
                                  <td> - </td>
                                  <td> AR$  {{ round(  $suma * 0.15,0 ) }} </td>
                                </tr>
                              @endif
                              @if($pedido->modo_venta == 'Ahora18')
                                <tr>
                                  <td></td>
                                  <td> Financiacion Ahora 18 </td>
                                  <td> 1 </td>
                                  <td> AR$ {{ round( $suma * 0.20,0 ) }} </td>
                                  <td> - </td>
                                  <td> AR$  {{ round( $suma * 0.20,0 ) }} </td>
                                </tr>
                              @endif

                      </tbody>

                      <tfooter>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th style="text-align:center">Total</th>
                                    <th style="text-align:center"> AR$ {{ round( round( $pedido->total,2 ),0) }}  </th>
                                </tr>
                      </tfooter>
            
                    </table>

                    
                </div>
              
                @if (getValueJS(Auth::user()->permisosERP,'pedidosPagos'))

                <div class="inside mtop16">

                    <div class="header">
                        
                          <h2 class="title"> <a href="{{url('Pedidos/Detalle/'.$pedido->id)}}"> <i class="fas fa-clipboard-list"></i> Listado de Pagos </a>  </h2> 
                    
                    </div>

                    <table class="table table-hover mtop16">
                                    
                        <thead>
                                
                            <tr>
                                <th> Fecha y Hora </th>
                                <th> Monto </th>
                                
                            </tr>

                        </thead>
                                    
                        <tbody>
                            
                        @foreach($pagos as $pago)
                        <tr>
                                <td> {{ $pago->getFromDateAttribute( $pago->created_at)}} </td>
                                <td> AR$ {{ number_format( round( $pago->monto ) , 2 , ',' , '.') }} </td>
                                

                        </tr>       
                        @endforeach   
                                    
                        </tbody>

                    </table>
                    
                </div>
              
                @endif

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
