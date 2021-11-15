@extends('layouts.app')

@section('title','Pagos')

@section('breadcrumb')

    <li class="breadcrumb-item">
                                        
        <a href="{{url('/pagos/index')}}" class="nav-link"><i class="fas fa-money-bill-wave"></i> Pagos  </a>
                                    
    </li>

@endsection

@section('content')

<div class="container-fluid">

    <div class="panel shadow">

        <div class="inside">

            <nav class="navbar navbar-light bg-light">
              
              <a class="navbar-brand"></a>
                      
                <form class="form-inline" action="{{ url('/pagos/index') }}">
  
                    <select class="form-control mr-sm-2" name="searchCondicion">
                                        
                        <option value="num_pedido">Numero Venta</option> 
                        
                        <option value="razon_Social">Cliente</option>  
  
                    </select>
                          
                    <input class="form-control mr-sm-2" type="search" name="searchText" placeholder="Search" aria-label="Search">
                        
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Buscar </button>
                    
                </form>
            
            </nav>

            <table class="table table-hover mtop16" id="datos">
                            
                <thead>
                                
                    <tr>
                        
                        <th>Numero</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Pagar</th>
                        <th style="display:none;">Id</th>
                        <th style="display:none;">Forma de Pago</th> 
                        <th style="display:none;">Total</th> 
                        <th>Observaciones</th>  

                    </tr>
                
                </thead>
                                        
                <tbody>

                    @foreach ($pedidos as $pedido)
                    
                    <tr>
                        <td> {{ $pedido->num_pedido }}</td>
                        <td> {{ $pedido->cliente->razon_Social }}</td>
                        <td> AR$ {{ number_format( round( $pedido->total ) , 2 , ',' , '.') }} </td>
                        <td> 

                            <div class="opts">
                                    
                                    @if (getValueJS(Auth::user()->permisosERP,'getPagosTotal'))
                                    <a class="warning" href="#" data-toggle="modal" data-target="#exampleModal" title="Registrar Pago" onclick="seleccionarProductos()"> Total </a>
                                    @endif
                                    <!---------------------- 
                                    <a class="edit" href="#" data-toggle="modal" data-target="#exampleModalMixto" title="Pago Mixto" onclick="seleccionarPago()"> Mixto </a>       
                                    ------------------->                    
                                    @if (getValueJS(Auth::user()->permisosERP,'getPagosParcial'))
                                    <a class="primary" href="{{ url('pagos/parcial/'.$pedido->id) }}" title="Eliminar Cliente"> Parcial </a>
                                    @endif
                            <div> 

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
                            <th colspan="8">{{$pedidos->render()}}</th>
                        </tr>
                    
                    </tfoot>
                    
            </table>
                    
        </div>
            
    </div>
            
</div>

<!---------------------------------------------------------------- Modal Registrar Pago-------------------------------------------------------------------------------------->


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
      
      <div class="modal-content">
		      
          <div class="modal-header">

              <h5 class="modal-title"> 

                  <a href="{{url('/cajas')}}"> 
                        
                        <i class="fas fa-money-bill-alt"></i> Registrar Pago 
                      
                  </a> 

              </h5> 
     	    
          </div>
          
          <div class="modal-body">
 
            {!! Form::open(['url'=>'/pagos/store']) !!}
            
                {!!Form::hidden('pedidoid',null,['class' => 'form-control','id' => 'pedidoid'])!!}

              <div class="row">

                  <div class="col-md-6">

                      <label for="name">Total a Pagar AR$ :</label>

                      <div class="input-group">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                          {!!Form::hidden('total',null,['class' => 'form-control','id' => 'total'])!!}
                          
                          {!!Form::text('totald',null,['class' => 'form-control','id' => 'totald', 'readonly'=>'true'])!!}

                      </div>

                  </div> 

                  <div class="col-md-6">

                      <label for="name"> Forma de Pago :</label>

                      <div class="input-group">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                          {!!Form::hidden('modo',null,['class' => 'form-control','id' => 'modo'])!!}
                          
                          {!!Form::text('modoVenta',null,['class' => 'form-control','id' => 'modoVenta', 'readonly'=>'true'])!!}

                      </div>

                  </div> 
                    
              </div>

                <div class="row mtop16" id="filaCheque">

                    <div class="col-md-6">

                        <label for="name">Numero Cheque</label>

                        <div class="input-group">
                            
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                            {!!Form::text('num_cheque',0,['class' => 'form-control','id' => 'cheque'])!!}

                        </div>

                    </div> 

                    <div class="col-md-6">

                        <label for="name"> Cuit Cheque:</label>

                        <div class="input-group">
                            
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                            {!!Form::text('cuil_cheque',0,['class' => 'form-control','id' => 'cheque'])!!}

                        </div>

                    </div> 
                    
                </div>
                  
              <div class="row mtop16">
                      
                  <div class="col-md-12">

                      <label for="name"> Observaciones</label>

                      <div class="input-group">
                          
                          <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>

                          {!!Form::textarea('img',null,['class' => 'form-control','id' => 'img' ])!!}

                      </div>

                  </div>
                  
              </div>

              <div class="row mtop16">
                        
                        <div class="col-md-12">
                            
                            {!!Form::submit('Guardar',['class' => 'btn btn-success', 'onclick'=>'barra()']) !!}    
                                    
                            {!!Form::button('Cerrar',['class' => 'btn btn-danger', 'data-dismiss'=>'modal']) !!} 
                        </div>

              </div>

              <div class="row mtop16">

                <div class="progress">
                    
                    <div id="bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                      
                        <span class="sr-only">0% Complete</span>
                      
                    </div>
                
                </div>
                
              </div>

            {!! Form::close() !!} 
                
          </div>

      </div>
    
    </div>

</div>

<!--------------------------------------------------------------------------------------------------------------------------------------------------------->

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


