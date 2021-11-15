@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Abrir Cajas {{$cajas->nombre}} </h1>
                </div>

              </div>
            </div><!-- /.container-fluid -->
          </section>

          @if ( count($errors) > 0 )

            <div class="alert alert-danger">
              
              <ul>
                  @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
            
            </div>
          
          @endif

          <div class="card card-secondary">
            
            <div class="card-header">
              <h3 class="card-title">Abrir Caja</h3>
            </div>

            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <br>
                  <p><b> Ultima Cotizacion Dolar: </b> AR$ {{$cajas->cotizacion}}</p>
                  <p><b> Saldo Actual: </b> AR$ {{$cajas->saldoPesos}}</p>
                </div>
                <div class="col-lg-6 col-md-6 col-dm-6 col-xs-12" id="guardar1">
                  <div class="form-group">
                      <button class="btn btn-info" data-toggle="modal" data-target="#ModalAbrir" title="Abrir Caja" data-original-title="Abrir Caja">Abrir</i></button>
                  </div>
		            </div>
              </div>
              
            </div>
          </div>

          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title"> Ultimos Movimientos </h3>
            </div>
            <table class="table table-hover text-nowrap" id="tablecliente">
              <thead>
                <tr>
                @if($cajas->estado == 'abierta')     
                  <th style="text-align:center;">
                                
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#ModalIngreso" title="Agregar Ingreso" data-original-title="Ver Detalle Cliente">
                    <i class="fas fa-plus"></i></a>
                    </button>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#ModalCliente" title="Retiro de Dinero" data-original-title="Ver Detalle Cliente">
                    <i class="fas fa-hand-holding-usd" style="color:red"></i></a>
                    </button>
                  </th>
                  @else
                      <th style="text-align:center;">Fecha</th>       
                      <th style="text-align:center;">Descripcion</th>
                      <th style="text-align:center;">Tipo</th>  
                      <th style="text-align:center;">Forma</th>
                      <th style="text-align:center;">Pedido</th>
                      <th style="text-align:center;">Ingreso</th>
                      <th style="text-align:center;">Egreso</th>
                @endif      
                </tr>
              </thead>
              <tbody>
              @foreach($movimientos as $movimiento)
              <tr>
                    <td style ="text-align:center;">{{$movimiento->getFromDateAttribute($movimiento->fecha)}} </td>
                    <td style ="text-align:center;">{{$movimiento->descripcion}} </td>
                    <td style ="text-align:center;">{{$movimiento->forma}} </td>
                    <td style ="text-align:center;">{{$movimiento->tipo}} </td>
                    <td style ="text-align:center;">{{$movimiento->num_pedido}} </td>
                    <td style="text-align:center;">AR$ {{$movimiento->entrada}} </td>
                    <td style="text-align:center;">AR$ {{$movimiento->salida}} </td>
              </tr>       
              @endforeach   
              </tbody>    
            </table>
            {{$movimientos->render()}}
          </div>
                </div>
              </div>
            </div>
          </div>


        </div>
    </div>
</div>

<!-- FIN Modal Agregar Dinero-->	



<div class="modal" id="ModalAbrir" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    
    <div class="modal-dialog">
        
        <div class="modal-content">
		        
            <div class="modal-header">
        	      <h5 class="modal-title" id="titulo">Abrir Caja</h5>		
     	      </div>
            
            <div class="modal-body">
	            
              <div class="card-body">

                  <form action="{{ route('cajas.abrirCerrar',$cajas->id)}}" role="form">
                    
                    {{ csrf_field() }}
                    
                    <div class="row">

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                          
                          <div class="form-group">
                              
                                  @if($cajas->id == 1)
                                  
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