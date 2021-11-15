@extends('layouts.munay')

@section('title','Seleccionar Cliente')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/Munay/Pedidos/Home')}}" class="nav-link"> <i class="fas fa-boxes"></i> Pedidos </a>
                                                                    
    </li>

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/Munay/Pedidos/Clientes')}}" class="nav-link"> <i class="fas fa-check"></i> Seleccionar Cliente </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href=""> <i class="fas fa-check"></i>  Seleccionar Cliente </a>  </h2> 
      
      </div>

         <div class="inside">

            <nav class="navbar navbar-light bg-light">
              
                <a class="navbar-brand"></a>
                    
                <form class="form-inline" action="{{url('/Munay/Pedidos/Clientes')}}">

                    <input class="form-control mr-sm-2" type="search" name="searchText" placeholder="Search" aria-label="Search">
                        
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Buscar </button>
                    
                </form>
          
            </nav>

            <div class="btns mtop16">

                <a href="{{url('/Munay/Clientes/create/1')}}" class="btn btn-primary" title="Agregar Cliente"><i class="fas fa-plus"></i></a>

            </div>
          
        <table class="table table-hover mtop16">
                        
            <thead>
                  
                <tr>
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th></th>
                </tr>

            </thead>
                        
            <tbody>
                
              @foreach ($clientes as $cliente)
                
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $cliente->num_cliente }} </td>
                    <td> {{ $cliente->razon_Social}} </td>  
                    <td>
                        <div class="opts">
                            <a class="edit" href="{{ url('/Munay/Pedidos/create/'.$cliente->id) }}" title="Seleccionar Cliente"> <i class="fas fa-check"></i> </a>                           
                        <div> 
                    </td>
                </tr>
              
              @endforeach
                        
            </tbody>

        </table>
                    
        {{$clientes->render()}}

      </div>

    </div>

</div>

@endsection