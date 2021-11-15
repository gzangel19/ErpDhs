@extends('layouts.munay')

@section('title','Pedidos')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/Munay/Pedidos/Home')}}" class="nav-link"> <i class="fas fa-money-check-alt"></i> Pedidos  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="{{url('/Munay/Pedidos/Home')}}"> <i class="fas fa-money-check-alt"></i> Pedidos  </a>  </h2> 
      
      </div>

      <div class="inside">

          <nav class="navbar navbar-light bg-light">
              
            <a class="navbar-brand"></a>
                    
              <form class="form-inline" action="{{ route('clientes.index') }}">

                  <select class="form-control mr-sm-2" name="searchCondicion">
                          
                    <option value="razon_Social"> Numero </option> 
                    <option value="num_cliente"> Codigo </option>  

                  </select>
                        
                  <input class="form-control mr-sm-2" type="search" name="searchText" placeholder="Search" aria-label="Search">
                      
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Buscar </button>
                  
              </form>
          
          </nav>

          <div class="btns mtop16">

            <a href="{{url('/Munay/Pedidos/Clientes')}}" class="btn btn-primary" title="Nueva Venta"><i class="fas fa-plus"></i> Nueva Venta </a>
          
          </div>
          
          <table class="table table-hover mtop16">
                        
            <thead>
                  
                <tr>
                    <th>Codigo</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Condicion</th>
                    <th></th>
                </tr>

            </thead>
                        
            <tbody>
                
              @foreach ($pedidos as $pedido)
                
                <tr>
                    <td> {{ $pedido->num_pedido }}</td>
                    <td> {{ $pedido->cliente->razon_Social }} </td>
                    <td> {{ $pedido->estado}} </td>
                    <td> {{ $pedido->pago }} </td>
                    <td>
                        <div class="opts">
                            <a class="warning" href="{{url('/pedidos/'.$pedido->id)}}" title="Ver Cliente"> <i class="far fa-eye"></i> </a>                           
                            <a class="delete" href="{{ url('/cliente/delete/'.$pedido->id) }}" title="Eliminar Cliente"> <i class="fas fa-trash"></i> </a>
                        <div> 
                    </td>
                </tr>
              
              @endforeach
                        
            </tbody>

        </table>
                    
        {{$pedidos->render()}}

      </div>

    </div>

</div>

@endsection

