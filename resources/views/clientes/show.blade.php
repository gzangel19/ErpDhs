@extends('layouts.app')

@section('title','Detalle Cliente')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/clientes')}}" class="nav-link"> <i class="fas fa-address-card"></i> Clientes  </a>
                                    
    </li>

    <li class="breadcrumb-item">
            
        <a href="{{url('/clientes/edit/'.$cliente->id)}}" class="nav-link"> <i class="fas fa-address-card"></i> Detalle Cliente {{ $cliente->razon_Social }}  </a>
                                                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="page_user">

        <div class="row mtop16">
                
            <div class="col-md-3">

                <div class="panel shadow">
                    
                    <div class="header">
                            
                        <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-user"></i> Información </a> </h2> 
                       
                    </div>

                    <div class="inside">

                        <div class="mini_profile">

                            <img src=" {{ url('img/default.png') }}" class ="avatar">               
                        
                            <div class="info">
                                
                                <span class="title"> <i class="fas fa-user-tie"></i> Apellido y Nombre </span>
                                    
                                <span class="text">  {{$cliente->razon_Social}} </span>

                                <span class="title"> <i class="far fa-envelope"></i> Correo Electrónico </span>
                                
                                <span class="text"> {{$cliente->email}} </span>

                                <span class="title"> <i class="far fa-calendar-alt"></i> Fecha de Registro </span>
                                
                                <span class="text"> {{$cliente->fecha($cliente->created_at)}} </span>

                                <span class="title"> <i class="fas fa-venus-mars"></i> Genero </span>
                                
                                <span class="text capitalize"> {{$cliente->genero}} </span>

                                <span class="title"> <i class="fas fa-phone"></i> Telefono </span>
                                
                                <span class="text capitalize"> {{$cliente->telefonos}} </span>

                                <span class="title"> <i class="fas fa-mobile-alt"></i> Celular </span>
                                
                                <span class="text capitalize"> {{$cliente->telefonos}} </span>

                                <span class="title"> <i class="fas fa-street-view"></i> Direccion </span>
                                
                                <span class="text capitalize"> {{$cliente->direccion}} </span>

                                <span class="title"> <i class="far fa-building"></i> Localidad </span>
                                
                                <span class="text capitalize"> {{$cliente->ciudad}} </span>

                                <span class="title"> <i class="fas fa-city"></i> Provincia </span>
                                
                                <span class="text capitalize"> {{$cliente->provincia->nombre}} </span>
                                
                            </div>
                            
                        </div>

                    </div>
                
                </div>

            </div>

            <div class="col-md-9">

                <div class="panel shadow">
                    
                    <div class="header">
                            
                        <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-shopping-bag"></i> Productos Comprados </a> </h2>
                        
                        <table class="table table-hover">
                        
                            <thead>
                                            
                                <tr>
                                    <th>Productos</th>
                                    <th>Cantidad</th>            
                                </tr>
                            
                            </thead>
                                                
                            <tbody>
                                            
                                @foreach ($productosComprados as $producto)
                                            
                                <tr>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->cantidad }}</td>
                                </tr>
                                        
                                @endforeach
                                                    
                            </tbody>
                        
                        </table>
                        
                    </div>

                </div>

                @if (getValueJS(Auth::user()->permisosERP,'clientesPagosParciales'))

                <div class="panel shadow mtop16">
    
                    <div class="header">
                        
                        <h2 class="title"> <a href="{{url('/clientes')}}">  <i class="fas fa-cash-register"></i> Pedidos Registrados </a>  </h2> 
                    
                    </div>

                    <div class="inside">
                        
                        <table class="table table-hover">
                                    
                        <thead>
                                            
                            <tr>

                                <th> Nº Pedido</th>
                                <th> Deposito </th>
                                <th> Total </th>
                                <th> Entrega </th>
                                <th> Estado </th>
                                <th> Saldo </th>
                                <th></th>
                                    
                            </tr>
                        
                        </thead>
                                                
                        <tbody>
                                        
                            @foreach ($clientesPedidos as $pedidos)
                                        
                                <tr class="<?php echo ($pedidos->pago!= 'Pagado')?'table-danger':'' ?>">
                                    <td> <a href="{{url('/Pedidos/Detalle/'.$pedidos->id)}}"> {{$pedidos->num_pedido}} </a> </td>
                                    <td>{{$pedidos->deposito->nombre}}</td>
                                    <td> AR$ {{$pedidos->total }}</td>
                                    <td>{{$pedidos->estado }}</td>
                                    <td>{{$pedidos->pago }}</td>
                                    @if($pedidos->pago != 'Pagado')
                                    <td> AR$ {{ number_format( round( ( $pedidos->deuda_pesos +   ($pedidos->deuda_dolares * $dolar->valor) - $pedidos->pago_parcial ) ) , 2 , ',' , '.') }} </td>
                                    @else
                                    <td> AR$ 0 </td>
                                    @endif
                                    <td>  
                                        <a class="btn btn-primary btn_pedidos" href="#" data-toggle="modal" data-target="#edit" data_object="{{$pedidos->id}}" title="Ver Pagos Registrados"> Ver Pagos </a>  
                                    </td>
                            </tr>
                                        
                            @endforeach
                                                
                        </tbody>
                        
                        </table>

                        {{$clientesPedidos->render()}}

                        <div class="btns mtop16">
            
                            @if (getValueJS(Auth::user()->permisosERP,'clientesReportePagosPDF'))

                                <a href="{{url('/cliente/reportePagos/'.$cliente->id)}}" class="btn btn-danger" title="Reporte PDF">  Historial de Compras </i></a>
                                
                            @endif

                        </div>

                    </div>



                </div>

                @endif

            </div>

        </div>

    </div>

    @include('clientes.clientesPedidos')
 
</div>

@endsection