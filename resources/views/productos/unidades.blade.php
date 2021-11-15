@extends('layouts.app')

@section('title','Unidad de Productos')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/productos/unidades')}}" class="nav-link"> <i class="fas fa-store"></i> Productos  </a>
                                    
    </li>

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/productos/unidades')}}" class="nav-link"> <i class="fas fa-store"></i> Unidades de Negocio  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">
    
      <div class="header">

          <h2 class="title"> <a href="{{url('/productos/unidades')}}"> <i class="fas fa-address-card"></i> Unidades de Negocio </a></h2> 
      
      </div>

      <div class="inside">
          
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
                                                        
                        @if (getValueJS(Auth::user()->permisosERP,'getProductos'))
                                  
                        <div class="opts">
                        
                            <a class="edit" href="{{url('productos/index/'.$unidad->id)}}" title="Ver Productos"> <i class="fas fa-box"></i> </a>                           
                        
                        <div> 

                        @endif

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