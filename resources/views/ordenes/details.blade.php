@extends('layouts.app')

@section('title','Detalle Orden')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('Ordenes/detalle/'.$order->id)}}" class="nav-link"> <i class="fas fa-store-alt"></i> Detalle Venta N° {{ $order->o_number }} </a>
                                    
    </li>

@endsection


@section('content')

<div class="container-fluid">

    <div class="cart mtop32">

        <div class="container">

            <div class="items mtop32">

                <div class="row">
                
                    <div class="col-md-9 shadow">

                        <div class="panel">

                            <div class="inside">

                                <div class="header">

                                    <h2 class="title"> <i class="fas fa-shopping-cart"></i> Detalle Orden {{ $order->o_number}} </h2>

                                </div>
                
                                <table class="table table-striped table-hover align-middle mtop16">

                                    <thead>

                                        <tr>
                                            <td width="80"> <strong></strong> </td>
                                            <td> <strong> Producto </strong> </td>
                                            <td width="160"> <strong> Cantidad </strong> </td>
                                            <td> <strong> Total </strong> </td>
                                            <td width="130"> <strong>SubTotal</strong> </td>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($order->getItems as $item)

                                            <tr>
                                            
                                                <td> <img src=" {{ url('img/productos/'.$item->getProduct->imagen) }}" class ="img-fluid rounded">  </td>
                                                
                                                <td> {{ $item->product_name }} </td>
                                                
                                                <td> {{ $item->cantidad }} </td>

                                                <td> AR$ {{ number_format($item->precio , 2 , ',' , '.') }} </td>
                                            
                                                <td> <strong> AR$ {{ number_format($item->subtotal , 2 , ',' , '.') }} </strong> </td>
                                            
                                            </tr>

                                        @endforeach

                                        <tr>
                                            <td colspan="3"> </td>
                                            <td> <strong> Total: </strong> </td>
                                            <td> <strong> AR$ {{ number_format($order->getTotal() , 2 , ',' , '.') }} </strong> </td>
                                        </tr>
                                
                                    </tbody>
                                
                                </table>

                            </div>

                        </div>
   
                        @if (getValueJS(Auth::user()->permisosERP,'eccomerceEdit'))

                        
                        <div class="row">

                            <div class="col-md-6 shadow">

                                <div class="panel mtop16">

                                    <div class="inside">

                                        <div class="header">

                                            <h2 class="title"> <i class="fas fa-unlock"></i>  Cambiar Estado </h2>

                                        </div>

                                        {!! Form::open(['url'=>'Orden/update/status/'.$order->id]) !!}
                                                     
                                            {!!Form::select('status',getOrderStatus(),$order->status,['class' => 'form-select'])!!}    

                                            {!!Form::submit('Guardar',['class' => 'btn btn-success mtop16']) !!}    

                                        {!! Form::close() !!}
                                                    
                                    </div>

                                </div>

                            </div>
                            
                            <div class="col-md-6 shadow">

                                <div class="panel mtop16">

                                    <div class="inside">

                                        <div class="header">

                                            <h2 class="title"> <i class="fas fa-file-upload"></i> Ultimo Comprobante Subido </h2>

                                        </div>

                                        <a  data-fancybox="gallery" href="{{ url('https://tiendadhs.com.ar/img/categorias/'.$order->imagen) }}"> 

                                            <img src="{{ url('https://tiendadhs.com.ar/img/categorias/'.$order->imagen) }} " width = "100%" class="mtop16" id="payment_method_trasfer_img" />

                                        </a>

                                    </div>

                                </div> 

                            </div>

                        </div>

                        @endif

                    </div>

                    <div class="col-md-3 shadow">

                        <div class="panel">

                            <div class="inside">

                                    <div class="header mtop16">

                                        <h2 class="title"> <i class="fas fa-credit-card"></i> Forma de Envio </h2>

                                    </div>

                                    <div class="playment_method">

                                        @if($order->forma_envio == "0")

                                        <a href="#" class="lk- @if($order->forma_envio == "0") active @endif"> <i class="fas fa-car-side"></i> Envio A Domicilio </a>
                                        
                                        @else
                                        
                                        <a href="#" class="lk- @if($order->forma_envio == "1") active @endif"> <i class="fas fa-car-side"></i> TO GO </a>

                                        @endif
                                        
                                    </div>


                                    @if($order->forma_envio == "0" && $order->user_direcciones_id != "0" )

                                        <div class="header mtop16">

                                            <h2 class="title"> <i class="fas fa-map-marker-alt"></i> Direccion de Envío </h2>

                                        </div>

                                        <div>

                                            <p> <strong>Nombre: </strong> {{ $order->getUserAddress->name }} </p>

                                            <p> <strong>Direccion: </strong> {{ $order->getUserAddress->direccion  }} </p>

                                            <p> <strong>Localidad: </strong> {{ $order->getUserAddress->localidad }} </p>

                                            <p> <strong>Provincia: </strong> {{ $order->getUserAddress->provincia->nombre }} </p>

                                            <p> <strong>Referencia: </strong> {{ $order->getUserAddress->referencia  }} </p>

                                        </div>

                                    @endif

                                    <div class="header mtop16">

                                        <h2 class="title"> <i class="fas fa-credit-card"></i> Metodo de Pago </h2>

                                    </div>

                                    <div class="playment_method">

                                        @if($order->payment_method == "0")

                                        <a href="#" class="lk- @if($order->payment_method == "0") active @endif"> <i class="fas fa-money-bill-alt"></i> Efectivo </a>
                                        
                                        @else

                                            @if($order->payment_method == "1")

                                            <a style="#" class="lk- @if($order->payment_method == "1") active @endif"> <i class="fas fa-credit-card"></i> Transferencia / Deposito </a>
                                        
                                            @else

                                            <a href="#" class="lk- @if($order->payment_method == "2") active @endif"> <i class="fas fa-money-check-alt"></i>  Mercado Pago </a>

                                            @endif

                                        @endif
                                    

                                    </div>

                                    <div class="header mtop16">

                                        <h2 class="title active"> <i class="fas fa-shopping-cart"></i> Más </h2>

                                    </div>

                                    <div>

                                        <p style="#"> {{ $order->descripcion }}</p>

                                    </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            
        </div>
    
    </div>

</div>

@endsection