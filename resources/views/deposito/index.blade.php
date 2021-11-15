@extends('layouts.app')

@section('title','Sucursales')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{ url('/depositos') }}" class="nav-link"> <i class="fas fa-warehouse"></i> Sucursales  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="{{url('/depositos')}}"><i class="fas fa-warehouse"></i> Listado Sucursales </a>  </h2> 
      
      </div>

      <div class="inside">

          @if (getValueJS(Auth::user()->permisosERP,'depositoSearch'))

          <div class="form_search" id="form_search">
                       
              <form action="{{ url('/depositos') }}">

                <div class="row">
                      
                    <div class="col-md-10 sinMargen">

                        <label class="title"> Busqueda: </label>
                        
                        <input class="form-control" type="search" name="searchText" placeholder="Search" aria-label="Search">
                      
                    </div>

                    <div class="col-md-2">

                        <label class="title">  </label>

                        <button class="btn btn-primary" type="submit"> Buscar </button>

                    </div>
                
                </div>
                  
              </form>
          
          </div>
          
          @endif

          <table class="table table-hover mtop16">
                        
              <thead>
                  
                      <tr>
                          @if (getValueJS(Auth::user()->permisosERP,'depositoAdd'))
                          <th> <div class="opts"> <a href="{{url('/depositos/create')}}" class="btn btn-primary" title="Agregar Deposito"><i class="fas fa-plus"></i> </a> </div> </th>
                          @else
                          <th> Razon Social </th>
                          @endif      
                          <th> Telefono </th>
                          <th> Provincia </th>
                          <th> Opciones </th>
                      </tr>

              </thead>
                        
            <tbody>
                
              @foreach ($depositos as $deposito)
                
                <tr>
                    <td> {{ $deposito->nombre }} </td>
                    <td> {{ $deposito->telefonos }} </td>
                    <td> {{ $deposito->provincia->nombre }}</td>
                    <td>
                        <div class="opts">
                            @if (getValueJS(Auth::user()->permisosERP,'depositoShow'))
                            <a class="primary" href="{{url('/deposito/detalle/'.$deposito->id)}}" title="Ver Deposito"> <i class="far fa-eye"></i> </a>
                            @endif
                            @if (getValueJS(Auth::user()->permisosERP,'depositoEdit'))
                            <a class="edit" href="{{ url('/depositos/edit/'.$deposito->id) }}" title="Editar Deposito"> <i class="fas fa-edit"></i> </a>                           
                            @endif            
                            @if (getValueJS(Auth::user()->permisosERP,'depositoMovimiento'))
                              <a class="delete" href="{{ url('depositos/moverProducto/'.$deposito->id) }}" title="Mover Productos"> <i class="fas fa-truck-moving"></i></a>
                            @endif
                        <div> 
                    </td>
                </tr>
              
              @endforeach
                        
            </tbody>

        </table>
                    
        {{$depositos->render()}}

      </div>

    </div>

</div>

@endsection

