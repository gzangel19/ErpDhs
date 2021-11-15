@extends('layouts.munay')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card card-primary">
              
              <div class="card-header">
                
                <h3 class="card-title">Pedidos Impagos</h3>

                  <div class="card-tools">
                    
                         <form class="form-inline" action="{{ route('pagos.index') }}" role="form">
                                
                                <div class="input-group input-group-sm" style="width: 400px;">
                                      
                                      <select class="form-control" name="searchCondicion">
                                        <option value="num_pedido">Numero Venta</option>              
                                      </select>
                                      
                                      <input type="text" name="searchText" class="form-control float-right" placeholder="Buscar">
                                                                    
                                      <div class="input-group-append">
                                          
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                      
                                      </div>
    
                                </div>
    
                          </form>

                  </div>

              </div>

              <div class="card-body table-responsive p-0">
                
                <table class="table table-hover text-nowrap" id="datos">
                  
                  <thead>
                    
                    <tr>                    
                      <th style="text-align:center;">Numero</th>
                      <th style="text-align:center;">Cliente</th>
                      <th style="text-align:center;">Total</th> 
                      <th style="text-align:center;"> Pagar </th>                
                      <th style="display:none;">Id</th>
                      <th style="display:none;">Forma de Pago</th> 
                      <th style="display:none;">Total</th> 
                      <th style="text-align:center;">Observaciones</th>                
                    </tr>
                  
                  </thead>
                  
                  <tbody>
                      @foreach ($pedidos as $pedido)
                      
                    <tr>
                        
                        <td style="text-align:center;">{{ $pedido->num_pedido }}</td>

                        <td style="text-align:center;">{{ $pedido->cliente->razon_Social }}</td>
                        
                        <td style="text-align:center;"> AR$ {{ $pedido->total }} </td>
                        
                        <td style="text-align:center;"> 
                            <a href="#" class="btn btn-link" data-toggle="modal" data-target="#exampleModal" title="Registrar Pago" data-original-title="Registrar Pago" onclick="seleccionarProductos()"> 
                            <i class="fas fa-money-bill" style="color:green"></i>
                            </a>
                            <a href="#" class="btn btn-link" data-toggle="modal" data-target="#exampleModalMixto" title="Pago Mixto" data-original-title="Pago Mixto" onclick="seleccionarPago()"> 
                            <i class="fas fa-money-check-alt"></i>
                            </a>
                        </td>
                        
                        <td style="display:none;"> {{ $pedido->id }} </td>
                        <td style="display:none;"> {{ $pedido->modo_venta }} </td>
                        <td style="display:none;"> {{ $pedido->total }} </td>
                        <td style="text-align:center;"> {{ $pedido->observaciones }} </td>
                        
                    </tr>
                      
                      @endforeach
                  </tbody>

                  <tfoot>

                    <tr>
                        <th</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                  
                  </tfoot>
                
                </table>
                
                {{$pedidos->render()}}
              
              </div>
            
            </div>

          </div>

          </div>

        </div>

    </div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
      
      <div class="modal-content">
		      
          <div class="modal-header" style="background-color: blue; color:white">
        	  
              <h5 class="modal-title" id="tituloUpdate">Registrar Pago</h5>
     	    
          </div>
          
          <div class="modal-body">

            <div class="card-body table-responsive p-0">
            
                <form method="post" action="{{ route('pagos.store')}}" role="form">
                  
                  {{ csrf_field() }}

                  <input type="hidden" class="form-control" placeholder="Enter ..." id="pedidoid" name="pedidoid">
                  
                  <div class="row">
                      
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                        
                            <label> Total a Pagar AR$ </label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="totald" name="totald" disabled>

                            <input type="hidden" class="form-control" placeholder="Enter ..." id="total" name="total">
                                                           
                        </div>
                      
                      </div>

                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        
                        <div class="form-group">
                        
                            <label> Forma de Pago </label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="modoVenta" name="modoVenta" disabled>

                            <input type="hidden" class="form-control" placeholder="Enter ..." id="modo" name="modo">
                                                           
                        </div>
                      
                      </div>
                                     
                  </div>
                  
                  <div class="row">
                      
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="form-group">
                        
                            <label>Observaciones</label>
                            
                            <input type="text" class="form-control" placeholder="Enter ..." id="img" name="img" value="Ninguno">
                                                        
                         </div>
                      
                      </div>

                  </div>


                  <div class="row">
                      
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      
                          <div class="form-group">
                          
                            <button type="submit" class="btn btn-success" onclick="barra()">Pagar </button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      
                          </div>
                      
                      </div>
                  
                  </div>

                  <div class="progress">
                  <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span class="sr-only">0% Complete</span>
                  </div>
                  </div>


                </form>  
                
            </div>

          </div>

      </div>
    
    </div>

</div>




<div class="modal fade" id="exampleModalMixto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
      
      <div class="modal-content">
		      
          <div class="modal-header" style="background-color: blue; color:white">
        	  
              <h5 class="modal-title" id="tituloUpdate">Pago Mixto</h5>
     	    
          </div>
          
          <div class="modal-body">

            <div class="card-body table-responsive p-0">
            
                <form method="post" action="{{ route('pagos.storeMixto')}}" role="form">
                  
                  {{ csrf_field() }}

                  <input type="hidden" class="form-control" placeholder="Enter ..." id="pedidoidMixto" name="pedidoidMixto">
                  
                  <div class="row">
                      
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="form-group">
                        
                            <label> Total a Pagar AR$ </label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="totaldMixto" name="totaldMixto" disabled>

                            <input type="hidden" class="form-control" placeholder="Enter ..." id="totalMixto" name="totalMixto">
                                                           
                        </div>
                      
                      </div>
                                     
                  </div>

                  <div class="row">
                      
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="form-group">
                        
                            <label> Efectivo </label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="efectivo" name="efectivo">

                        </div>
                      
                      </div>
                                     
                  </div>

                  <div class="row">
                      
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="form-group">
                        
                            <label> Transferencia Bancaria </label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="transferencia" name="transferencia">
                                                                 
                        </div>
                      
                      </div>
                                     
                  </div>

                  <div class="row">
                      
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="form-group">
                        
                            <label> Cheque </label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="cheque" name="cheque">
                                                                 
                        </div>
                      
                      </div>
                                     
                  </div>

                  <div class="row">
                      
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="form-group">
                        
                            <label> Tarjeta de Credito </label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="tarjeta" name="tarjeta">
                                                                 
                        </div>
                      
                      </div>
                                     
                  </div>

                  <div class="row">
                      
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        
                        <div class="form-group">
                        
                            <label> Mercado Pago </label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="mercado" name="mercado">
                                                                 
                        </div>
                      
                      </div>
                                     
                  </div>
                  

                  <div class="row">
                      
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                      
                          <div class="form-group">
                          
                            <button type="submit" class="btn btn-success" onclick="barra()">Pagar </button>

                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      
                          </div>
                      
                      </div>
                  
                  </div>

                  <div class="progress">
                  <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span class="sr-only">0% Complete</span>
                  </div>
                  </div>


                </form>  
                
            </div>

          </div>

      </div>
    
    </div>

</div>




</div>

</div>
@endsection

@push ('scripts')
  
<script>

function seleccionarProductos(){

$("table tbody tr").click(function() {
    
    
    var filaid= $(this).find("td:eq(4)").text();
    var filamodo= $(this).find("td:eq(5)").text();
    var filatotal= $(this).find("td:eq(6)").text();

    $("#pedidoid").val(filaid);

    $("#totald").val(filatotal);

    $("#total").val(filatotal);

    $("#modoVenta").val(filamodo);

    $("#modo").val(filamodo);

});
}


function seleccionarPago(){

$("table tbody tr").click(function() {
    
    
    var filaid= $(this).find("td:eq(4)").text();
    var filatotal= $(this).find("td:eq(6)").text();

    $("#pedidoidMixto").val(filaid);

    $("#totaldMixto").val(filatotal);

    $("#totalMixto").val(filatotal);


});
}


function barra(){
  var progreso = 0;
      var idIterval = setInterval(function(){
        // Aumento en 10 el progeso
        progreso +=5;
        $('#bar').css('width', progreso + '%');
      
      //Si llegó a 100 elimino el interval
        if(progreso == 100){
       clearInterval(idIterval);
      }
      },1000);
}


</script>
@endpush


