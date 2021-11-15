@extends('layouts.app')

@section('title','CAJA')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/cajas')}}" class="nav-link"> <i class="fas fa-cash-register"></i> Cajas  </a>
                                    
    </li>


@endsection


@section('content')
    <div class="container-fluid">

        <div class="panel shadow">
            
            <div class="header">
                
                <h2 class="title"> <a href="{{url('/cajas')}}"> <i class="fas fa-cash-register"></i> Cajas </a>  </h2> 
            
            </div>

            <div class="inside">

                <div class="btns">

                    <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i></a>

                </div>

                <table class="table table-striped mtop16">
                    <thead>
                      <tr>
                          <th>Nombre</th>
                          <th>Saldo</th>
                          <th>Estado</th>
                          <th>Cotizacion</th>
                          <th></th>
                      </tr>
                    </thead>
                
                    <tbody>

                      @foreach($cajas as $caja)
                      
                      <tr>
                          <td>{{$caja->nombre}} </td>
                          <td> AR$ {{ number_format( round( $caja->saldoPesos ), 2 , ',' , '.')}} </td>
                          <td>{{$caja->estado}}</td>
                          <td>AR$ {{$dolar->valor}}</td>
                          @if($caja->estado == 'cerrada')
                            <td>
                                <a href="{{ route('cajas.show', $caja->id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Abrir Caja" data-original-title="Abrir Caja"> Abrir Caja</a>
                            </td>
                            @else
                              <td>

                                <div class="opts">
                                        
                                        <a class="primary" href="#" data-toggle="modal" data-target="#ModalIngreso" title="Ingresar Dinero"> <i class="far fa-thumbs-up"></i> </a> 
                                        <a class="warning" href="#" data-toggle="modal" data-target="#ModalRetiro" title="Retirar Dinero"> <i class="fas fa-thumbs-down"></i> </a>
                                        <a class="delete" href="{{ url('caja/dia/'.$caja->id) }}" title="Cerrar Caja"> <i class="fas fa-times"></i> </a>
                                <div> 

                              </td>
                          @endif
                      
                      </tr> 

                      @endforeach  

                    </tbody>    
                  
                    {{$cajas->render()}}
                  
                  </table>
           
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
                    
                    <i class="fas fa-money-bill-alt"></i> Ingreso de Dinero {{ Auth::user()->caja->nombre }}
                  
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
