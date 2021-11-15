@extends('layouts.app')

@section('title','CAJA')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="#" class="nav-link"> <i class="fas fa-cash-register"></i> Movimiento Diario   </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">

        <div class="row mtop16">

            <div class="col-md-4">
    
                <div class="inside">

                    <div class="header">
                        
                        <h2 class="title"> <a href=""> <i class="fas fa-cash-register"></i> Informacion de Caja </a>  </h2> 
                    
                    </div>

                    <div class="info">

                        <span class="title"> <i class="fas fa-id-card"></i> Nombre: </span>

                        <span> {{ Auth::user()->caja->nombre }} </span>

                        <span class="title"> <i class="fas fa-envelope"></i> Estado: </span>

                        <span> {{ Auth::user()->caja->estado }}</span>

                        <span class="title"> <i class="fas fa-money-bill-wave"></i> Cotizacion Dolar: </span>

                        <span> AR$ {{  $dolar->valor }}</span>

                        <span class="title"> <i class="fas fa-calendar-alt"></i> Saldo en Caja: </span>

                        <span> AR$ {{ Auth::user()->caja->saldoPesos }}</span>

                    </div>
                        
                </div>

            </div>
                
            <div class="col-md-8">

                <div class="inside">
                    
                    <div class="header">
                        
                        <h2 class="title"> <a href="#"> <i class="fas fa-cash-register"></i> Movimientos </a>  </h2> 
                    
                    </div>

                    <div class="btns">

                        <div class="opts mtop16">

                            @if( Auth::user()->caja->estado == 'cerrada')

                                @if (getValueJS(Auth::user()->permisosERP,'getAbrirCaja'))

                                <a class="primary" href="#" data-toggle="modal" data-target="#ModalAbrirCaja" title="Abrir Caja "> <i class="fas fa-lock-open"></i> </a> 

                                @endif
                                
                            @else

                                @if (getValueJS(Auth::user()->permisosERP,'getIngresoDinero'))
                                <a class="edit" href="#" data-toggle="modal" data-target="#ModalIngreso" title="Ingresar Dinero"> <i class="far fa-thumbs-up"></i> </a> 
                                @endif

                                @if (getValueJS(Auth::user()->permisosERP,'getRetiroDinero'))
                                <a class="warning" href="#" data-toggle="modal" data-target="#ModalRetiro" title="Retirar Dinero"> <i class="fas fa-thumbs-down"></i> </a>
                                @endif

                                @if (getValueJS(Auth::user()->permisosERP,'getCerrarCaja'))
                                <a class="delete" href="{{ url('/caja/dia/'.Auth::user()->caja->id) }}" title="Cerrar Caja"> <i class="fas fa-times"></i> </a>
                                @endif

                            @endif

                        </div>   

                    </div>

                    <table class="table table-hover mtop16">
                                    
                        <thead>
                                
                            <tr>
                                <th> Fecha y Hora </th>
                                <th> Tipo </th>
                                <th> Descripcion </th>
                                <th> Entrada </th>
                                <th> Salida </th>
                                <th> Forma </th>
                                <th> N° Cheque </th>
                            </tr>

                        </thead>
                                    
                        <tbody>
                            
                        @foreach($movimientos as $movimiento)
                        <tr>
                                <td> {{$movimiento->getFromDateAttribute($movimiento->fecha)}} </td>
                                <td> {{$movimiento->forma }} </td>
                                <td> {{$movimiento->descripcion}} </td>
                                <td> AR$ {{$movimiento->entrada}} </td>
                                <td> AR$ {{$movimiento->salida}} </td>
                                <td> {{$movimiento->tipo}} </td>
                                <td> {{$movimiento->num_cheque}} </td>
                        </tr>       
                        @endforeach   
                                    
                        </tbody>

                    </table>
                                
                </div>

            </div>

            
        </div>

    </div>

</div>

<!---------------------------------------------------------------- Modal Agregar Dinero-------------------------------------------------------------------------------------->

<div class="modal fade bd-example-modal-lg" id="ModalIngreso" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
		        
            <div class="modal-header">

              <h5 class="modal-title"> 
                
                  <a href="{{url('/cajas')}}"> 
                    
                    <i class="fas fa-money-bill-alt"></i> Ingreso de Dinero Munay {{ Auth::user()->caja->nombre }}
                  
                  </a> 
              
              </h5> 
        	      
     	      </div>
            
            <div class="modal-body">
 
                {!! Form::open(['url'=>'/cajas/ingresar/'.Auth::user()->caja_id]) !!}
               
                    <div class="row">  

                        <div class="col-md-12">
                            
                            <label for="name">Detalle:</label>

                            <div class="input-group">
                                
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            
                                {!!Form::text('descripcion',null,['class' => 'form-control','id' => 'editor'])!!} 
                            
                            </div>
                                
                        </div>

                    </div>

                    <div class="row mtop16">

                        <div class="col-md-6">
                            
                            <label for="name">Monto:</label>

                            <div class="input-group">
                                
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            
                                {!!Form::number('monto',null,['class' => 'form-control','min' => 0.00, 'step' => 'any'])!!}
                            
                            </div>
                                
                        </div>

                        <div class="col-md-6">
                            
                            <label for="en descuento">Forma</label>

                            <div class="input-group">
                                
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            
                                {!!Form::select('modoPago',['Efectivo' => 'Efectivo','Transferencia Bancaria' => 'Transferencia Bancaria','Cheque' => 'Cheque'],0,['class' => 'form-select'])!!}    
                            
                            </div>
                            
                        </div>
                    
                    </div>

                    <div class="row mtop16">
                        
                        <div class="col-md-12">
                            
                            {!!Form::submit('Guardar',['class' => 'btn btn-success']) !!}    
                                    
                            {!!Form::button('Cerrar',['class' => 'btn btn-danger', 'data-dismiss'=>'modal']) !!} 
                        </div>

                    </div>

                {!! Form::close() !!}

                 
            </div>

        </div>

    </div>

</div>

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


<!---------------------------------------------------------------- Modal Cotizacion Dolar-------------------------------------------------------------------------------------->


<div class="modal fade bd-example-modal-lg" id="ModalDolar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
		        
            <div class="modal-header">

                <h5 class="modal-title"> 
                    
                    <a href="#"> 
                      
                      <i class="fas fa-money-bill-alt"></i> Modificar Cotizacion Dolar
                    
                    </a> 
                
                </h5> 
        			  
            </div>
            
            <div class="modal-body">

                {!! Form::open(['url'=>'/cajas/dolar/cotizacion']) !!}
                  
                  <div class="row">  

                      <div class="col-md-12">
                          
                          <label for="name">Cotizacion:</label>

                          <div class="input-group">
                              
                              <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                          
                              {!!Form::number('dolar',null,['class' => 'form-control','min' => 0.00, 'step' => 'any'])!!}
                          
                          </div>
                              
                      </div>

                  </div>

                  <div class="row mtop16">
                      
                      <div class="col-md-12">
                          
                          {!!Form::submit('Guardar',['class' => 'btn btn-success']) !!}    
                                  
                          {!!Form::button('Cerrar',['class' => 'btn btn-danger', 'data-dismiss'=>'modal']) !!} 
                      </div>

                  </div>

              {!! Form::close() !!}

            </div>
	          
        </div>

    </div>

</div>


<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


<!---------------------------------------------------------------- Modal Retiro Dinero-------------------------------------------------------------------------------------->


<div class="modal fade bd-example-modal-lg" id="ModalRetiro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
		        
            <div class="modal-header">

                <h5 class="modal-title"> 
                    
                    <a href="{{url('/cajas')}}"> 
                      
                      <i class="fas fa-money-bill-alt"></i> Retiro de Dinero {{ Auth::user()->caja->nombre }}
                    
                    </a> 
                
                </h5> 
        			  
            </div>
            
            <div class="modal-body">

                {!! Form::open(['url'=>'/cajas/resta/'.Auth::user()->caja_id]) !!}
                  
                  <div class="row">  

                      <div class="col-md-12">
                          
                          <label for="name">Detalle:</label>

                          <div class="input-group">
                              
                              <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                          
                              {!!Form::text('descripcion',null,['class' => 'form-control','id' => 'editor'])!!} 
                          
                          </div>
                              
                      </div>

                  </div>

                  <div class="row mtop16">

                      <div class="col-md-6">
                          
                          <label for="name">Monto:</label>

                          <div class="input-group">
                              
                              <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                          
                              {!!Form::number('monto',null,['class' => 'form-control','min' => 0.00, 'step' => 'any'])!!}
                          
                          </div>
                              
                      </div>

                      <div class="col-md-6">
                          
                          <label for="en descuento">Forma</label>

                          <div class="input-group">
                              
                              <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                          
                              {!!Form::select('modoPago',['Efectivo' => 'Efectivo','Transferencia Bancaria' => 'Transferencia Bancaria','Cheque' => 'Cheque'],0,['class' => 'form-select'])!!}    
                          
                          </div>
                          
                      </div>
                  
                  </div>

                  <div class="row mtop16">
                      
                      <div class="col-md-12">
                          
                          {!!Form::submit('Guardar',['class' => 'btn btn-success']) !!}    
                                  
                          {!!Form::button('Cerrar',['class' => 'btn btn-danger', 'data-dismiss'=>'modal']) !!} 
                      </div>

                  </div>

              {!! Form::close() !!}

            </div>
	          
        </div>

    </div>

</div>


<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<div class="modal" id="ModalAbrirCaja" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog">
        
        <div class="modal-content">
		        
            <div class="modal-header">
        	      <h5 class="modal-title" id="titulo">Abrir Caja</h5>		
     	      </div>
            
            <div class="modal-body">
	            
              <div class="card-body">

                  <form action="{{ route('cajas.abrirCerrar',Auth::user()->caja_id)}}" role="form">
                    
                    <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          
                          <div class="form-group">
                              
                                  @if(Auth::user()->caja_id == 1)
                                  
                                  <label>Cotizacion del Dolar</label>

                                  <div class="input-group">

                                    <div class="input-group-prepend">
                                      
                                      <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>

                                    </div>
                                      
                                    <input type="text" class="form-control input-lg" placeholder="Enter ..." id="cotizacion" name="cotizacion">

                                  </div>

                                  </br>

                                  @endif
                                  
                                  <label>Ingreso Inicial</label>

                                    <div class="input-group">

                                      <div class="input-group-prepend">
                                        
                                        <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>

                                      </div>
                                        
                                      <input type="text" class="form-control input-lg" placeholder="Enter ..." id="ingresoInicial" name="ingresoInicial">

                                  </div>
                     
                          </div>
                    
                      </div>

                    </div>  
                    
                    <br>
                    
                    <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    
                        <div class="form-group">
                    
                          <button type="submit" class="btn btn-primary">Abrir</button>

                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    
                        </div>
                      
                      </div>
                    
                    </div>

                  </form>  
                  
              </div>

            </div>
          
        </div>

    </div>

</div>


<!-- FIN Modal Agregar Dinero-->	

@endsection
