@extends('layouts.Sinopsys')

@section('title','PRODUCTOS')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/Sinopsys/Productos')}}" class="nav-link"> <i class="fas fa-boxes"></i> Productos  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">
          
          <h2 class="title"> <a href="{{url('#')}}"> <i class="fas fa-boxes"></i> Productos </a>  </h2> 
      
      </div>

      <div class="inside">

          <div class="btns mtop16">


          </div>

          <nav class="navbar navbar-light bg-light">
              
            <a class="navbar-brand"></a>
                    
              <form class="form-inline" action="{{ url('/Sinopsys/Productos') }}">
                        
                  <input class="form-control mr-sm-2" type="search" name="searchText" placeholder="Search" aria-label="Search">
                      
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Buscar </button>
                  
              </form>
          
          </nav>

        <div class="btns mtop16">

            <a href="{{url('/Sinopsys/Productos/Create')}}" class="btn btn-primary" title="Nuevo Producto"><i class="fas fa-plus"></i> Agregar </a>

        </div>
          
        <table class="table table-hover mtop16">
                        
            <thead>
                  
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th></th>
                </tr>

            </thead>
                        
            <tbody>
                
              @foreach ($articulos as $articulo)
                
                <tr>
                    <td width="64px">
                        <a  data-fancybox="gallery" href="{{ url('img/productos/'.$articulo->imagen) }}"> 
                        <img src=" {{ url('img/productos/'.$articulo->imagen) }}" width="64px" > 
                        </a>
                    </td>
                    <td> {{ $articulo->nombre }} </td>
                    <td> AR$ {{ number_format( round( $articulo->precioLocal ), 2 , ',' , '.')}} </td>
                    <td>
                        <div class="opts">
                            <a class="warning" href="{{url('/Munay/Productos/Detalle/'.$articulo->id)}}" title="Ver Producto"> <i class="far fa-eye"></i> </a>
                            <a class="edit" href="{{ url('/Munay/Productos/edit/'.$articulo->id) }}" title="Editar Producto"> <i class="fas fa-edit"></i> </a>                           
                        <div>
                    </td>
                </tr>
              
              @endforeach
                        
            </tbody>

        </table>
                    
        {{$articulos->render()}}

      </div>

    </div>

</div>

@endsection

