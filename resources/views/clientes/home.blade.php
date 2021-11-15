@extends('layouts.app')

@section('title','Clientes')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/clientes')}}" class="nav-link"> <i class="fas fa-address-card"></i> Clientes  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">

        <div class="inside">
       
            @if (getValueJS(Auth::user()->permisosERP,'clienteSearch'))
            
            <div class="form_search mtop16" id="form_search">

                {!! Form::open(['url'=>'/clientes','method' => 'GET']) !!}
                                
                <div class="row">
                    
                    <div class="col-md-8 sinMargen">

                        <label class="title"> Busqueda: </label>

                        {!! Form::text('searchText',null,['class' => 'form-control','placeholder' => 'Ingrese Su Busqueda']) !!}   

                    </div>

                    <div class="col-md-2">
                    
                        <label class="title"> Condicion: </label>

                        {!! Form::select('searchCondicion',['razon_Social' => 'Nombre','num_cliente' => 'N° Cliente'],0,['class' => 'form-select']) !!}  

                    </div>

                    <div class="col-md-2">

                          <label class="title">  </label>

                          {!!Form::submit('Buscar',['class' => 'btn btn-primary']) !!}   
                           
                    </div>

                </div>

                {!! Form::close() !!}
            
            </div>
 
            @endif

            <div class="btns mtop16">

                @if (getValueJS(Auth::user()->permisosERP,'clientesAdd'))

                    <a href="{{url('/clientes/create')}}" class="btn btn-primary" title="Agregar Cliente"> Agregar Cliente  <i class="fas fa-plus"></i></a>

                @endif

                @if (getValueJS(Auth::user()->permisosERP,'clientesExcel'))
                    
                    <a href="{{url('/cliente/exportar')}}" class="btn btn-success" title="Reporte Excel"> Reporte en Excel  <i class="fas fa-file-excel"></i></a>

                @endif

                @if (getValueJS(Auth::user()->permisosERP,'clientesPDF'))

                    <a href="{{url('/cliente/pdf')}}" class="btn btn-danger" title="Reporte PDF"> Reporte en PDF  <i class="fas fa-file-pdf"></i></a>
                    
                @endif

            </div>

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
                                        
                                        @if (getValueJS(Auth::user()->permisosERP,'clienteShow'))
                                            
                                            <a class="primary" href="{{url('clientes/detalle/'.$cliente->id)}}" title="Ver Cliente"> <i class="far fa-eye"></i> </a>
                                        
                                        @endif

                                        @if (getValueJS(Auth::user()->permisosERP,'clientesEdit'))
                                            
                                            <a class="edit" href="{{ url('clientes/edit/'.$cliente->id) }}" title="Editar Cliente"> <i class="fas fa-edit"></i> </a>                           
                                        
                                        @endif

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

