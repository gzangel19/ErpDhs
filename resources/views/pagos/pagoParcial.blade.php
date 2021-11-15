@extends('layouts.app')

@section('title','Pago Parcials')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('pagos/parcial/.$pedido->id')}}" class="nav-link"> <i class="fas fa-cash-register"></i> Pago Parcial   </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">

        <div class="row mtop16">

            <div class="col-md-4">
    
                <div class="inside">

                    <div class="header">
                        
                        <h2 class="title"> <a href="{{url('pagos/parcial/'.$pedido->id)}}"> <i class="fas fa-cash-register"></i> Datos de la Venta </a>  </h2> 
                    
                    </div>

                    <div class="info">

                        <span class="title"> <i class="fas fa-id-card"></i> Cliente: </span>

                        <span> {{ $pedido->cliente->razon_Social }} </span>

                        <span class="title"> <i class="far fa-calendar-alt"></i> Estado: </span>

                        <span> {{ $pedido->pago }}  </span>

                        <span class="title"> <i class="far fa-calendar-alt"></i> Fecha y Hora: </span>

                        <span> {{ $pedido->getFromDateAttribute( $pedido->fecha) }}  </span>

                        <span class="title"> <i class="fas fa-sort-numeric-up-alt"></i> N° Venta: </span>

                        <span> {{ $pedido->num_pedido }}</span>

                        <span class="title"> <i class="fas fa-money-check-alt"></i> Total Venta: </span>

                        <span> AR$ {{ number_format( round( $pedido->total ) , 2 , ',' , '.') }} </span>

                        <span class="title"> <i class="fas fa-money-check-alt"></i> Saldo a Pagar: </span>

                        <span> AR$ {{ number_format( round( ( ( $pedido->deuda_pesos +   ($pedido->deuda_dolares * $dolar->valor) ) - $pedido->pago_parcial ) ) , 2 , ',' , '.') }} </span>

                        @if ($pedido->pago == 'Impago' && Auth::user()->tipo != 'vendedor')
                            
                            <a href="{{url('pedido/cerrar/'.$pedido->id)}}" class="btn btn-primary mtop16" style="width:100%"> Finalizar </a> 

                        @endif

                    </div>
                        
                </div>

            </div>
                
            <div class="col-md-8">

                <div class="inside">
                    
                    <div class="header">
                        
                        <h2 class="title"> <a href="{{url('/Munay/cajas')}}"> <i class="fas fa-cash-register"></i> Movimientos </a>  </h2> 
                    
                    </div>

                    <div class="btns">

                        <div class="opts mtop16">

                            @if($pedido->pago != "Pagado")

                            <a class="edit" href="#" data-toggle="modal" data-target="#exampleModalMixto" title="Ingresar Dinero"> Registrar Pago </a> 
                            
                            @endif

                            <a class="delete" href="{{ url('/pagos/index') }}" title="Volver"> <i class="fas fa-arrow-left"></i> Volver </a>

                        </div>   

                    </div>

                    <table class="table table-hover mtop16">
                                    
                        <thead>
                                
                            <tr>
                                <th> Fecha y Hora </th>
                                <th> Monto </th>
                                
                            </tr>

                        </thead>
                                    
                        <tbody>
                            
                        @foreach($pagos as $pago)
                        <tr>
                                <td> {{ $pago->getFromDateAttribute( $pago->created_at)}} </td>
                                <td> AR$ {{ number_format( round( $pago->monto ) , 2 , ',' , '.') }} </td>
                                

                        </tr>       
                        @endforeach   
                                    
                        </tbody>

                    </table>
                                
                </div>

            </div>

            
        </div>

    </div>

</div>

@endsection

<!--------------------------------------------------------------------------------------------------------------------------------------------------------->

<div class="modal fade" id="exampleModalMixto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
        
        <div class="modal-content">
      
            <div class="modal-header">
                
                <h5 class="modal-title" id="exampleModalLabel">Registrar Pago Parcial</h5>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        
                        <span aria-hidden="true">&times;</span>
                    
                    </button>
            </div>
      
            <div class="modal-body">
            
            {!! Form::open(['url'=>'/pagos/parcial/store/'.$pedido->id]) !!}

                <div class="row">

                        <div class="col-12">

                            <label for="name">Total a Pagar AR$ :</label>

                            <div class="input-group">
                                
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                                {!!Form::hidden('pedidoidMixto',null,['class' => 'form-control','id' => 'pedidoidMixto'])!!}
                                
                                {!!Form::text('totalMixto', number_format( round( ( $pedido->deuda_pesos +   ($pedido->deuda_dolares * $dolar->valor) - $pedido->pago_parcial ) ) , 2 , ',' , '.') ,['class' => 'form-control','readonly'=>'true'])!!}
                            
                            </div>

                        </div> 

                        <div class="col-6 mtop16">

                            <label for="name">Efectivo:</label>

                            <div class="input-group">
                                
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                
                                {!!Form::text('efectivo',0,['class' => 'form-control','id' => 'efectivo'])!!}

                            </div>

                        </div> 

                        <div class="col-6 mtop16">

                            <label for="name"> Mercado Pago </label>

                                <div class="input-group">
                                    
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    
                                    {!!Form::text('mercado',0,['class' => 'form-control','id' => 'mercado'])!!}

                                </div>

                        </div> 

                        <div class="col-6 mtop16">

                            <label for="name"> Transferencia Bancaria:</label>

                            <div class="input-group">
                                
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                
                                {!!Form::text('transferencia',0,['class' => 'form-control','id' => 'transferencia'])!!}

                            </div>

                        </div>

                        <div class="col-6 mtop16">

                            <label for="name">Tarjeta de Credito:</label>

                            <div class="input-group">
                                
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                
                                {!!Form::text('tarjeta',0,['class' => 'form-control','id' => 'tarjeta'])!!}

                            </div>

                        </div> 

                        <div class="col-md-12">

                            <label for="name"> Cheque </label>

                                <div class="input-group">
                                
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                
                                {!!Form::text('cheque',0,['class' => 'form-control','id' => 'cheque'])!!}

                            </div>

                        </div>

                        <div class="col-6 mtop16">

                            <label for="name"> N° Cheque </label>

                                <div class="input-group">
                                    
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    
                                    {!!Form::text('num_cheque',0,['class' => 'form-control','id' => 'cheque'])!!}

                                </div>

                        </div> 

                        <div class="col-6 mtop16">

                            <label for="name"> CUIT Cheque </label>

                                <div class="input-group">
                                
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                
                                {!!Form::text('cuil_cheque',0,['class' => 'form-control','id' => 'cheque'])!!}

                            </div>

                        </div> 

                        <div class="col-md-12 mtop16">
                              
                              {!!Form::submit('Guardar',['class' => 'btn btn-success', 'onclick'=>'barra()']) !!}    
                                      
                              {!!Form::button('Cerrar',['class' => 'btn btn-danger', 'data-dismiss'=>'modal']) !!} 
                          
                        </div>

                        <div class="col-md-12 mtop16">

                            <div class="progress">
                                
                                <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                    
                                    <span class="sr-only">0% Complete</span>
                                    
                                </div>

                            </div>

                        </div>

                </div> 

                {!! Form::close() !!} 

            </div>

        </div>

    </div>

</div>


