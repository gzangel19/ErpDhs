@extends('layouts.munay')

@section('title','CAJA')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/Munay/cajas')}}" class="nav-link"> <i class="fas fa-cash-register"></i> Movimiento Diario   </a>
                                    
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

                        <span class="title"> <i class="fas fa-calendar-alt"></i> Saldo en Caja: </span>

                        <span> AR$ {{ Auth::user()->caja->saldoPesos }}</span>

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

                            @if( Auth::user()->caja->estado == 'cerrada')

                            <a class="primary" href="{{ url('/Munay/Caja/abrir/'.Auth::user()->caja->id) }}" data-toggle="tooltip" title="Abrir Caja" data-original-title="Abrir Caja"> <i class="fas fa-lock-open"></i> </a>

                            @else

                            <a class="edit" href="#" data-toggle="modal" data-target="#ModalIngreso" title="Ingresar Dinero"> <i class="far fa-thumbs-up"></i> </a> 
                            
                            <a class="warning" href="#" data-toggle="modal" data-target="#ModalRetiro" title="Retirar Dinero"> <i class="fas fa-thumbs-down"></i> </a>
                            
                            <a class="delete" href="{{ url('/Munay/Cajas/detalle/'.Auth::user()->caja->id) }}" title="Cerrar Caja"> <i class="fas fa-times"></i> </a>
                            
                            @endif

                        </div>   

                    </div>

                    <table class="table table-hover mtop16">
                                    
                        <thead>
                                
                            <tr>
                                <th> Fecha y Hora </th>
                                <th> Descripcion </th>
                                <th> Entrada </th>
                                <th> Salida </th>
                                <th> Forma </th>
                            </tr>

                        </thead>
                                    
                        <tbody>
                            
                        @foreach($movimientos as $movimiento)
                        <tr>
                                <td> {{$movimiento->getFromDateAttribute($movimiento->fecha)}} </td>
                                <td> {{$movimiento->descripcion}} </td>
                                <td> AR$ {{$movimiento->entrada}} </td>
                                <td> AR$ {{$movimiento->salida}} </td>
                                <td> AR$ {{$movimiento->salida}} </td>
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
 
                {!! Form::open(['url'=>'/Munay/Caja/ingresar/'.Auth::user()->caja_id]) !!}
               
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


@endsection
