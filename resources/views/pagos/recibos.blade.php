@extends('layouts.app')

@section('title','Recibos')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/pagos/index')}}" class="nav-link"><i class="fas fa-money-bill-wave"></i> Recibos  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">

        <div class="inside">

            <nav class="navbar navbar-light bg-light">
              
              <a class="navbar-brand"></a>
                      
                <form class="form-inline" action="{{ url('/pagos/recibos') }}">
  
                    <select class="form-control mr-sm-2" name="searchCondicion">
                        
                        <option value="cliente">Cliente</option> 
                        <option value="num_cheque">Numero Cheque</option> 
                        
                     
                    </select>
                          
                    <input class="form-control mr-sm-2" type="search" name="searchText" placeholder="Search" aria-label="Search">
                        
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Buscar </button>
                    
                </form>
            
            </nav>

            <table class="table table-hover mtop16" id="datos">
                            
                <thead>
                                
                    <tr>
                        
                        <th>Numero de Cheque</th>
                        <th>Numero de Pedido</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Saldo</th>
 
                    </tr>
                
                </thead>
                                        
                <tbody>

                    @foreach ($pedidos as $pedido)
                    
                    <tr>
                        <td> {{ $pedido->numeroCheque }}</td>
                        <td> {{ $pedido->num_pedido }}</td>
                        <td> {{ $pedido->cliente->razon_Social }}</td>
                        <td> AR$ {{ number_format( round( $pedido->total ) , 2 , ',' , '.') }} </td>
                        <td> {{ $pedido->pago }}</td>
                        <td> AR$ {{ number_format( round( ( $pedido->deuda_pesos +   ($pedido->deuda_dolares * $dolar->valor) - $pedido->pago_parcial ) ) , 2 , ',' , '.') }} </timezone_identifiers_list>
                    </tr>
                    
                    @endforeach
                            
                    </tbody>

                    <tfoot>

                        <tr>
                            <th colspan="5">{{$pedidos->render()}}</th>
                        </tr>
                    
                    </tfoot>
                    
            </table>
                    
        </div>
            
    </div>
            
</div>

@endsection