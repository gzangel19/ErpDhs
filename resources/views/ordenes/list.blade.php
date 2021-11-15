@extends('layouts.app')

@section('title','Ordenes Ecommerce')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('Ordenes/all')}}" class="nav-link"> <i class="fas fa-store-alt"></i> Ventas Eccomerce </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">
        
    <div class="row">

        <div class="col-md-3">

            @if (getValueJS(Auth::user()->permisosERP,'ordenFilter'))

            <div class="panel shadow">
                
                <div class="header">

                    <h2 class="title"> <a href="#"> <i class="fas fa-filter"></i> Filtrar Por Estado </a> </h2> 

                </div>

                <div class="list-group">

                    <a href="{{url('/Ordenes/all/'.$forma)}}" class="list-group-item list-gruop-item-action @if($status == "all") active @endif" aria-current="true"> <i class="fas fa-chevron-right"></i> Todas  <span class="badge badge-primary badge-pill">{{ $all_orders->where('status','!=','0')->count() }}</span> </a>

                    @foreach(Arr::except(getOrderStatus(),['0']) as $key => $value)

                    <a href="{{url('/Ordenes/'.$key.'/'.$forma)}}" class="list-group-item list-gruop-item-action @if($status == "$key") active @endif" aria-current="true"> <i class="fas fa-chevron-right"></i> {{$value}}  <span class="badge badge-primary badge-pill">{{ $all_orders->where('status','==',$key)->count() }}</span> </a>
                    
                    @endforeach

                </div>

            </div>
            
            @endif
        
        </div>

        <div class="col-md-9">

            <div class="panel shadow">
                
                <div class="header">

                    <h2 class="title"> <a href="#"> <i class="fas fa-list"></i> Listado </a> </h2> 

                </div>

                <div class="inside formaEnvio">

                    <ul class="nav nav-pills nav-fill">

                        <li class="nav-item">
                        
                            <a class="nav-link  @if($forma == "all") active @endif" aria-current="page" href="{{url('/Ordenes/'.$status.'/all')}}"> Todas </a>
                        
                        </li>

                        @foreach(getOrderEnvio() as $key => $value)

                        <li class="nav-item">
                        
                            <a class="nav-link  @if($forma == "$key") active @endif" aria-current="page" href="{{url('/Ordenes/'.$status.'/'.$key)}}"> {{$value}} </a>
                        
                        </li>

                        @endforeach
                    
                    </ul>

                    
                    <div class="form_search" id="form_search">

                        {!! Form::open(['url'=>'Orden/Search','method' => 'POST']) !!}
                                        
                            <div class="row mtop16">
                                
                                <div class="col-md-10 sinMargen">

                                    <label class="title"> Busqueda: </label>

                                    {!! Form::text('searchText',null,['class' => 'form-control','placeholder' => 'Ingrese Su Busqueda']) !!}   

                                </div>

                                <div class="col-md-2">

                                    <label class="title">  </label>

                                    {!!Form::submit('Buscar',['class' => 'btn btn-primary']) !!}    

                                </div>

                            </div>

                        {!! Form::close() !!}

                    </div>

                    <table class="table table-hover align-middle mtop16">

                        <thead>

                            <tr>
                                
                                <td width="170"> <strong> # </strong> </td>
                                <td width="160"> <strong> Cliente </strong> </td>
                                <td width="160"> <strong> Estado </strong> </td>
                                <td width="124"> <strong> Total </strong> </td>
                                <td width="150"> <strong> Opciones </strong> </td>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($orders as $order)

                                <tr>
                                
                                    <td> {{$order->o_number}}  </td>
                                    <td> {{$order->getUser->getCliente->razon_Social}}  </td>
                                    <td> {{getOrderStatus($order->status)}}  </td>
                                    <td> AR$ {{ number_format($order->total , 2 , ',' , '.') }} </td>
                                    @if (getValueJS(Auth::user()->permisosERP,'eccomerceShow'))
                                    <td> <a href="{{url('/Orden/detalle/'.$order->id)}}" class="btn btn-success boton" title="Detalle de la Orden"> <i class="fas fa-clipboard"></i> </a>  </td>
                                    @endif

                                </tr>

                            @endforeach

                        </tbody>

                        <tfoot>

                                <tr> <th colspans="5">{{ $orders->render() }}</th>  </tr>

                        </tfoot>

                    </table>

                </div>

            </div>

        </div> 

@endsection