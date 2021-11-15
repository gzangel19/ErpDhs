@extends('layouts.munay')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1> Balance Diario de Caja Munay </h1>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-sm-6">
                
                <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                      <th style="text-align:center;">Forma</th> 
                        <th style="text-align:center;">Ingresos En Pesos:</th> 
                        <th style="text-align:center;">Egresos En Pesos:</th>    
                        <th style="text-align:center;">Total</th>          
                        <th style="text-align:center;">Ingresos En Dolares:</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    <tr>
                          <td style ="text-align:center;">Efectivo</td>
                          <td style ="text-align:center;">AR$ {{$efectivo->totalpesos}} </td>
                          <td style ="text-align:center;">AR$ {{$efectivo->totalSalida}} </td>
                          <td style ="text-align:center;">AR$ {{$efectivo->totalpesos - $efectivo->totalSalida}} </td>
                          <td style ="text-align:center;">U$D {{$efectivo->totaldolares}} </td>
                    </tr>   
                    <tr>
                          <td style ="text-align:center;">Cheque </td>
                          <td style ="text-align:center;">AR$ {{$cheque->totalpesos}} </td>
                          <td style ="text-align:center;">AR$ {{$cheque->totalSalida}} </td>
                          <td style ="text-align:center;">AR$ {{$cheque->totalpesos - $cheque->totalSalida}} </td>
                          <td style ="text-align:center;">U$D {{$cheque->totaldolares}} </td>
                          
                    </tr>   
                    <tr>
                          <td style ="text-align:center;">Transferencia Bancaria</td>
                          <td style ="text-align:center;">AR$ {{$transferencia->totalpesos}} </td>
                          <td style ="text-align:center;">AR$ {{$transferencia->totalSalida}} </td>
                          <td style ="text-align:center;">AR$ {{$transferencia->totalpesos - $transferencia->totalSalida}} </td>
                          <td style ="text-align:center;">U$D {{$transferencia->totaldolares}} </td>
                    </tr>  
                    <tr>
                          <td style ="text-align:center;">Mercado Pago</td>
                          <td style ="text-align:center;">AR$ {{$mercado->totalpesos}} </td>
                          <td style ="text-align:center;">AR$ {{$mercado->totalSalida}} </td>
                          <td style ="text-align:center;">AR$ {{$mercado->totalpesos - $mercado->totalSalida}} </td>
                          <td style ="text-align:center;">U$D {{$mercado->totaldolares}} </td>
                    </tr>       
                    </tbody>    
                
                </table>
                
                </div>
              </div>

              <div class="row mb-2">

                <div class="col-lg-6 col-md-6 col-dm-6 col-xs-12" id="guardar1">
                  <div class="form-group">
                      @if($cajas->estado == 'abierta')
                      <form class="" action="{{ route('munayCajas.abrirCerrar',$cajas->id)}}" method="post">
                          
                          {{ csrf_field() }}
                          
                          {{ method_field('PUT') }}

                          <button type="submit" onclick="return confirm('Cerrar Caja?, Una vez cerrada no podra realizar el balance del dia')"  class="btn btn-danger" data-toggle="tooltip" title="Cerrar Caja" data-original-title="Editar Cliente">Cerrar</i></button>
                          
                          <a class="btn btn-dark" href="{{ url('/Munay/Pdf/Reporte') }}" role="button">Imprimir</a>
                      </form>
                      @endif
                      
                  </div>
		            </div>

                <div class="col-sm-6">
               
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Detalle de Movimientos</h3>
            </div>
            
            <table class="table table-hover text-nowrap" id="tablecliente">
              <thead>
                <tr>
                  <th style="text-align:center;">Hora</th>              
                      <th style="text-align:center;">Descripcion</th>
                      <th style="text-align:center;">Ingreso</th>
                      <th style="text-align:center;">Egreso</th>
                      <th style="text-align:center;">Tipo</th>
                </tr>
              </thead>
              <tbody>
              @foreach($movimientos as $movimiento)
              <tr>
                    <td style ="text-align:center;">{{$movimiento->getFromDay($movimiento->fecha)}} </td>
                    <td style ="text-align:center;">{{$movimiento->descripcion}} </td>
                    <td style="text-align:center;">AR$ {{$movimiento->entrada}} </td>
                    <td style="text-align:center;">AR$ {{$movimiento->salida}} </td>
                    <td style="text-align:center;"> {{$movimiento->tipo}} </td>
              </tr>       
              @endforeach   
              </tbody>    
            </table>

          </div>
                </div>
              </div>
            </div>
          </div>


        </div>
    </div>
</div>

<!-- Modal Crear Cajas-->

<div class="modal fade bd-example-modal-lg" id="ModalCliente" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
		        
            <div class="modal-header">
        	      <h5 class="modal-title" id="titulo">Retiro de Dinero</h5>		
     	      </div>
            
            <div class="modal-body">
	            
              <div class="card-body">

                  <form method="post" action="{{ route('cajas.resta',$cajas->id)}}" role="form">
                    
                    {{ csrf_field() }}
                    
                    <div class="row">

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Detalle</label>

                                  <div class="input-group">

                                    <div class="input-group-prepend">
                                      
                                      <span class="input-group-text" id="basic-addon1"><i class="far fa-keyboard"></i></span>

                                    </div>
                                      
                                    <input type="text" class="form-control input-lg" placeholder="Enter ..." id="descripcion" name="descripcion">

                                  </div>
                     
                          </div>
                    
                      </div>

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          
                          <div class="form-group">
                              
                              <label>Monto</label>
                              
                              <div class="input-group">

                                <div class="input-group-prepend">
                                  
                                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>

                                </div>
                                  
                                <input type="number" step="0.01" class="form-control input-lg" placeholder="Enter ..." id="monto" name="monto">

                              </div>
                     
                          </div>

                      </div>
                
                    </div>
                    
                    <br>
                    
                    <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    
                        <div class="form-group">
                    
                          <button type="submit" class="btn btn-primary">Ingresar</button>
                    
                        </div>
                      
                      </div>
                    
                    </div>


                  </form>  
                  
              </div>

            </div>
            
            <div class="modal-footer">
              
              <button type="button" class="btn btn-link" data-dismiss="modal"><i class="fas fa-times" style="color:red; font-size: 30px;"></i></button>
            
            </div>
        
        </div>

    </div>

</div>

@endsection