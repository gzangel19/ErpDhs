@extends('layouts.app')

@section('title','Usuarios')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/usuarios')}}" class="nav-link"> <i class="fas fa-users"></i> Listado Usuarios </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">
        
    <div class="panel shadow">
            
        <div class="header">
        
              <h2 class="title"> <a href="#" class="nav-link"> <i class="fas fa-users"></i> Usuarios </a> </h2> 
            
        </div>

        <div class="inside">

            <div class="form_search" id="form_search">

                {!! Form::open(['url'=>'/usuarios','method' => 'GET']) !!}
                                  
                  <div class="row">
                      
                      <div class="col-md-8 sinMargen">

                          <label class="title"> Busqueda: </label>

                          {!! Form::text('searchText',null,['class' => 'form-control','placeholder' => 'Ingrese Su Busqueda']) !!}   

                      </div>

                      <div class="col-md-2">
                      
                          <label class="title"> Estado: </label>

                          {!! Form::select('status',['Activo' => 'Activo','baja' => 'Eliminado'],0,['class' => 'form-select']) !!}  

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
                              
                              <a href="{{ route('usuarios.create') }}" class="btn btn-link" data-toggle="tooltip" title="Agregar Usuario" data-original-title="Agregar Usuario">
                                
                                <i class="fas fa-plus"></i>
                              
                              </a>
                            
                          </th>
                        
                          <th>Estado</th>

                          <th>Usuario</th>
                          
                          <th>Tipo</th>
                        
                          <th>Opciones</th>

                      </tr>
                    
                </thead>

                <tbody>

                        @foreach ($usuarios as $usuario)

                        <tr>
                    
                            <td>{{ $usuario->apellido }}, {{ $usuario->nombre }}</td>
                            <td>{{ $usuario->estado }}</td>
                            <td>{{ $usuario->username }}</td>
                            <td>{{ $usuario->tipo }}</td>
                            
                            <td>

                                @if($usuario->estado == 'activo')
                                  
                                <form action="{{ route('usuarios.inactivo',$usuario->id) }}" method="POST">
                    
                                    @csrf
                                      
                                    @method('PUT')
                        
                                    <button type="submit" class="btn btn-danger"> <i class="fas fa-user-minus"></i> </button>
                                  
                                    <a href="{{ url('/usuarios/'. $usuario->id.'/permisos')}}" class="btn btn-primary" title="Permisos de Usuario"> <i class="fas fa-cogs"></i> </a> 
                                    
                                </form>

                                @else

                                    <form action="{{ route('usuarios.activo',$usuario->id) }}" method="POST">
                      
                                        @csrf

                                        @method('PUT')
                          
                                        <button type="submit" class="btn btn-primary"> <i class="fas fa-user-plus"></i> </button>

                                        <a href="{{ url('/usuarios/'. $usuario->id.'/permisos')}}" class="btn btn-primary" title="Permisos de Usuario"> <i class="fas fa-cogs"></i> </a> 

                                    </form>

                                @endif

                                
                              
                            </td>  

                        </tr>

                        @endforeach

                </tbody>

            </table>

            {{$usuarios->render()}}

        </div>

    </div>

</div>

@endsection