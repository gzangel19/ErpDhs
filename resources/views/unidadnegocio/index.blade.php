@extends('layouts.app')

@section('title','Unidad de Productos')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/unidades')}}" class="nav-link"> <i class="fas fa-store"></i> Unidades de Negocio  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">

          <h2 class="title"> <a href="{{url('/unidades')}}"> <i class="fas fa-store"></i> Unidades de Negocio </a></h2> 
      
      </div>

      <div class="inside">

          <div class="btns mtop16">

              <a href="{{url('/unidades/create')}}" class="btn btn-primary" title="Agregar Unidad de Negocio"><i class="fas fa-plus"></i></a>

          </div>

          <nav class="navbar navbar-light bg-light">

              <a class="navbar-brand"></a>
                      
              <form class="form-inline" action="{{ route('unidades.index') }}">
                          
                  <input class="form-control mr-sm-2" type="search" name="searchText" placeholder="Search" aria-label="Search">
                      
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Buscar </button>
                  
              </form>

          </nav>
              
          <table class="table table-hover mtop16">
                            
                  <thead>
                                  
                    <tr>
                          
                      <th>Logo</th>
                      <th>Unidad de Negocio</th>
                      <th></th>
                      
                    </tr>
                
                  </thead>
                                        
                  <tbody>
                                
                  @foreach ($unidadesnegocio as $unidad)
                                
                    <tr>
                                    
                        <td width="64px">
                            <a  data-fancybox="gallery" href="{{ url('img/unidades/'.$unidad->imagen) }}"> 
                            <img src=" {{ url('img/unidades/'.$unidad->imagen) }}" width="64px" > 
                            </a>
                        </td>
                        <td>{{ $unidad->nombre }}</td>
                        <td>
                            <div class="opts">
                                <a class="warning" href="{{url('unidades/detalle/'.$unidad->id)}}" title="Ver Cliente"> <i class="far fa-eye"></i> </a>
                                <a class="edit" href="{{ url('unidades/editar/'.$unidad->id) }}" title="Editar Cliente"> <i class="fas fa-edit"></i> </a>                           
                            <div> 
                        </td>
                      
                    </tr>
                              
                  @endforeach
                                        
                  </tbody>
                
          </table>
                                    
          {{$unidadesnegocio->render()}}

      </div>

    </div>

</div>

@endsection