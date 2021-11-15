@extends('layouts.app')

@section('title','PEDIDOS')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/Pedidos/Index/all')}}" class="nav-link"> <i class="fas fa-shopping-cart"></i> Ventas </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">
        
        <div class="panel shadow">
            
            <div class="header">
                <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-shopping-cart"></i> Ventas </a> </h2> 
            </div>

            <div class="inside">

                <div class="form_search" id="form_search">

                    {!! Form::open(['url'=>'Pedidos/Search','method' => 'POST']) !!}
                                      
                      <div class="row">
                          
                          <div class="col-md-2 sinMargen">

                              <label class="title"> Busqueda: </label>

                              {!! Form::text('searchText',null,['class' => 'form-control','placeholder' => 'Ingrese Su Busqueda']) !!}   

                          </div>

                          <div class="col-md-2">

                              <label class="title"> Filtro: </label>

                              {!! Form::select('searchCondicion',['razon_Social' => 'Cliente', 'num_pedido' => 'Numero Venta'],0,['class' => 'form-select']) !!}   

                          </div>

                          <div class="col-md-2">
                          
                              <label class="title"> Vendedor: </label>
                              
                                <select class="form-select" name="vendedor">
 
                                    <option value="Todos">Todos</option>

                                    @foreach($vendedores as $vendedor)

                                    <option value="{{$vendedor->id}}">{{$vendedor->apellido}},{{$vendedor->nombre}}</option>

                                    @endforeach

                                </select>

                          </div>

                          <div class="col-md-2">
                          
                              <label class="title"> Estado: </label>

                              {!! Form::select('status',['Todos' => 'Todos','Entregado' => 'Entregado','Preparando' => 'Preparando','Cancelado' => 'Cancelado'],0,['class' => 'form-select']) !!}  

                          </div>

                          <div class="col-md-2">
                          
                              <label class="title"> Pago: </label>

                              {!! Form::select('statusPago',['Todos' => 'Todos', 'Impago' => 'Impago','Pagado' => 'Pagado'],0,['class' => 'form-select']) !!}  

                          </div>

                          <div class="col-md-2">

                              <label class="title">  </label>

                              {!!Form::submit('Buscar',['class' => 'btn btn-primary']) !!}    

                          </div>

                      </div>

                    {!! Form::close() !!}

                </div>

                <table class="table mtop16">
                  
                  <thead>
                    
                    <tr>                                
                      
                        <th>
                            
                            <div class="btns">

                                <a href="{{url('/pedidos/seleccionar')}}" class="btn btn-primary" title="Nueva Venta"><i class="fas fa-plus"></i></a>

                                <a href="{{url('/pedidos/reporte/pdf')}}" class="btn btn-danger"><i class="fas fa-file-pdf"></i></i></a>

                                <a href="{{url('/pedidos/reporte/excel')}}" class="btn btn-success"><i class="fas fa-file-excel"></i></a>

                            </div>

                        </th>

                      <th>Cliente</th>
                      <th>Vendedor</th>
                      <th>Deposito</th>
                      <th>Entrega</th>
                      <th>Pago</th>
                      <th></th>

                    </tr>
                  
                  </thead>
                  
                  <tbody>
                      @foreach ($pedidos as $pedido)
                      
                    <tr>
                        <td>{{ $pedido->num_pedido }}</td>
                        <td>{{ $pedido->cliente->razon_Social }}</td>
                        <td>{{ $pedido->user->nombre }}</td>
                        <td>{{ $pedido->deposito->nombre}}</td>
                        <td>{{ $pedido->estado}}</td>
                        <td>{{ $pedido->pago}}</td>
                        <td> 
                          <div class="opts">
                            
                              <a class="warning" href="{{url('/Pedidos/Detalle/'.$pedido->id)}}" title="Detalle Venta"> <i class="far fa-eye"></i> </a>

                              <a class="primary" href="{{url('/pdf/remitox/'.$pedido->id)}}" title="Detalle Venta"> <i class="fas fa-print"></i> </a>
                                
                          <div>  
             
                        </td>
                    </tr>
                      
                      @endforeach
                  </tbody>

                  <tfoot>

                    <tr>
                        <th colspans="6">{{ $pedidos->render() }}</th>
                    </tr>
                  
                  </tfoot>
                
                </table>

@endsection


