@extends('layouts.munay')

@section('title','CLIENTES')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/clientes')}}" class="nav-link"> <i class="fas fa-address-card"></i> Clientes  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="{{url('/clientes')}}"> <i class="fas fa-address-card"></i> Clientes </a>  </h2> 
      
      </div>

      <div class="inside">

          <div class="btns mtop16">

              <a href="{{url('/Munay/Clientes/create/0')}}" class="btn btn-primary" title="Agregar Cliente"><i class="fas fa-plus"></i></a>

          </div>

          <nav class="navbar navbar-light bg-light">
              
            <a class="navbar-brand"></a>
                    
              <form class="form-inline" action="{{ route('clientes.index') }}">

                  <select class="form-control mr-sm-2" name="searchCondicion">
                          
                    <option value="razon_Social">Nombre</option> 
                    <option value="num_cliente">Numero Cliente</option>  

                  </select>
                        
                  <input class="form-control mr-sm-2" type="search" name="searchText" placeholder="Search" aria-label="Search">
                      
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Buscar </button>
                  
              </form>
          
          </nav>
          
        <table class="table table-hover mtop16">
                        
            <thead>
                  
                <tr>
                    <th>Codigo</th>
                    <th>Razon Social</th>
                    <th>Telefono</th>
                    <th>E-Mail</th>
                    <th></th>
                </tr>

            </thead>
                        
            <tbody>
                
              @foreach ($clientes as $cliente)
                
                <tr>
                    <td>{{$cliente->num_cliente}}</td>
                    <td>{{ $cliente->razon_Social }}</td>
                    <td> {{ $cliente->telefonos }}</td>
                    <td> {{ $cliente->email }}</td>
                    <td>
                        <div class="opts">
                            <a class="warning" href="{{url('/Munay/Clientes/detalle/'.$cliente->id)}}" title="Ver Cliente"> <i class="far fa-eye"></i> </a>
                            <a class="edit" href="{{ url('/Munay/Clientes/edit/'.$cliente->id) }}" title="Editar Cliente"> <i class="fas fa-edit"></i> </a>                           
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

