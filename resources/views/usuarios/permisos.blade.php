@extends('layouts.app')

@section('title','Permisos de Usuario')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/admin/users/all')}}" class="nav-link"> <i class="fas fa-user"></i> Usuarios </a>
                                                                    
    </li>
                                

    <li class="breadcrumb-item">
                                        
        <a href="#" class="nav-link"> <i class="fas fa-cogs"></i>  Permisos de {{ $user->apellido }} {{ $user->nombre }} </a>
                                                                    
    </li>


@endsection

@section('content')

    <div class="container-fluid">

        <div class="page_user">

            <form action="{{ url('/users/'.$user->id.'/permisos') }}" method="post">

                @csrf

                <div class="row">
            
                    @foreach(userPermissions() as $key => $value)

                    <div class="col-md-4 d-flex mb32">

                        <div class="panel shadow">
            
                            <div class="header">

                                <h2 class="title"> <a href="#" class="nav-link"> {!! $value['icon'] !!} </i> {{$value['title']}} </a> </h2> 
                            
                            </div>

                            <div class="inside">

                                @foreach($value['keys'] as $k => $v)
                            
                                <div class="form-check">

                                    <input type="checkbox" value="true" name="{{$k}}" @if (getValueJS($user->permisosERP,$k)) checked @endif>

                                    <label for="dashboard" class=""> {{$v}} </label>

                                </div>

                                @endforeach
                            
                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                <div class="row mtop16">
                    
                    <div class="col-md-12">
                        
                        <div class="panel shadow">
                        
                            <div class="inside">
                                
                                <input type="submit" class="btn btn-primary" value="Guardar">
                            
                            </div>

                        </div>

                    </div>

                </div>

            </form>
                
        </div>

    </div>

 @endsection

