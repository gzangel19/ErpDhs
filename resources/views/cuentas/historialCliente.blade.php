@extends('layouts.app')
@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

          <section class="content-header">

          <div class="container-fluid">

            <div class="row mb-2">
              
              <div class="col-sm-6">

                <h1>Detalle de Cuenta Corriente</h1>
                <br>
               
                <p>Cliente <strong> {{$cliente->razon_Social}}  </strong> Direccion <strong>  {{$cliente->direccion}} , {{$cliente->ciudad}} , {{$cliente->provincia->nombre}} </strong></p>

                <p>Telefono <strong> {{$cliente->telefonos}}  </strong> E-Mail <strong>  {{$cliente->email}}  </strong></p>
                
                <p>Credito Asignado <strong> USD: {{$cliente->montoCuenta}}  </strong> Cuenta Asignado <strong> AR$: {{$cliente->montoCuentaPesos}}  </strong></p>

                <p>Saldo Total <strong> AR$: {{$totalGeneral}} </strong>  a T.C de <strong> AR$ {{$dolar->valor}}</strong> </p>
              </div>

            </div>

          </div>
            
          </section>

          <div class="card card-secondary">

            <div class="card-header">

              <h3 class="card-title">Historial de Ventas</h3>

            </div>

            <div class="card-body">

              <div class="row">

                <table class="table table-hover text-nowrap">
                    
                    <thead>
                      
                      <tr>
                        <th style="text-align:center; display:none;">id</th>  
                        <th style="text-align:center; display:none;">cotizacion</th>
                        <th style="text-align:center; display:none;"> Saldo U$D</th>     
                        <th style="text-align:center; display:none;"> Saldo AR$</th>   
                        <th style="text-align:center;">Fecha</th>     
						            <th style="text-align:center;"> Venta</th>     
                        <th style="text-align:center; display:none;"> Total </th>
                        <th style="text-align:center;"> Saldo U$D</th>     
                        <th style="text-align:center;"> Saldo AR$</th> 
                        <th style="text-align:center;"> Atraso</th> 
                        <th style="text-align:center;">Ingresar Pagos</th>     
                        <th style="text-align:center;">Comprobantes</th>                                  
                      </tr>

                    </thead>

                    <tbody>
                      @foreach ($pagos as $pago)
                      <tr>
                        <td style="text-align:center; display:none;"> {{$pago->id}}</td>
                        <td style="text-align:center; display:none;"> {{$dolar->valor}}</td>
                        <td style="text-align:center; display:none;"> {{round($pago->montoRestante,2)}}</td>
                        <td style="text-align:center; display:none;"> {{round($pago->montoRestantePesos)}}</td>
                        <td style="text-align:center;"> {{ $pago->getFromDateAttribute($pago->created_at) }}</td>
						            <td style="text-align:center;"> {{ $pago->pedido->num_pedido }}</td>
                        <td style="text-align:center; display:none;"> AR$ {{ $pago->pedido->total }}</td>
                        <td style="text-align:center;"> U$D {{ round($pago->montoRestante, 2)}}</td>
                        <td style="text-align:center;"> AR$ {{ $pago->montoRestantePesos }}</td>
                            @if($pago->estado != 'pagado')
                            <td style="text-align:center;">{{ $pago->calcularDias($pago->pedido->fecha) }} Dias</td>
                            @else
                            <td style="text-align:center;">-</td>
                            @endif
                        @if($pago->estado != 'pagado')
                        <td style="text-align:center;"> <a href="#" class="btn btn-link" data-toggle="modal" data-target="#exampleModal" title="Registrar Pago" data-original-title="Registrar Pago" onclick="ingresarPagos()"> <i class="fas fa-money-bill" style="color:green"></i></a></td>
                        @else
                            <td style="text-align:center;">-</td>
                        @endif
                        <td style="text-align:center;"> <a href="{{ route('cuentas.historial',$pago->id)}}" class="btn btn-link"  title="Historial de Pagos" data-original-title="Historial de Pagos"><i class="fas fa-file-alt" style="font-size: 20px;"></i></a></td>
                      </tr>
                      @endforeach
                    </tbody>

                </table>
                {{$pagos->render()}}
                <br>

              </div>
            
            </div>
          
          </div>
        
        </div>

        </div>
        
        <div class="form-group">
            
            <a class="btn btn-success" href="{{ route('pdf.historialPagos', $cliente->id)}}" role="button">Imprimir </a>
        		
            <a class="btn btn-danger" href="{{ route('cuentas.index') }}" role="button">Volver </a>
        
        </div>
      
      </div>
        
  </div>

</div>

<!-- Modal Ingreso Pagos -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
      
      <div class="modal-content">
		      
          <div class="modal-header">
        	  
              <h5 class="modal-title" id="tituloUpdate">Registrar Pago</h5>

          </div>
          
          <div class="modal-body">

            <div class="card-body table-responsive p-0">
            
                <form method="post" action="{{ route('cuentas.store')}}" role="form">
                  
                  {{ csrf_field() }}

                  <input type="hidden" class="form-control" placeholder="Enter ..." id="pagos_id" name="pagos_id">
                  
                  <div class="row">
                      
                      <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
                        
                        <div class="form-group">
                        
                            <label>* Total a Pagar U$D</label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="totald" name="totald" disabled>
                            
                            <label id="label1" style="font: bold 90% monospace;"></label>                  
                       </div>
                      
                      </div>

                      <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
                        
                        <div class="form-group">
                        
                            <label>Total a Pagar A$D</label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="totalp" name="totalp" disabled>
                            
                            
                       </div>
                      
                      </div>
                    
                  </div>
                  
                  <div class="row">
                      
                      <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
                        
                        <div class="form-group">
                        
                            <label>Monto Dolar</label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="monto" name="montod" value="0" onkeyup="calcularVuelto()">

                            <input type="hidden" class="form-control" placeholder="Enter ..." id="montoDolares" name="montodolares" value="0">

                            <input type="hidden" class="form-control" placeholder="Enter ..." id="cotizacion" name="cotizacion" value="{{$dolar->valor}}">

                            <label id="label2" style="font: bold 90% monospace;"></label>   

                         </div>
                      
                      </div>

                      <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
                        
                        <div class="form-group">
                        
                            <label>Monto Pesos</label>
                        
                            <input type="text" class="form-control" placeholder="Enter ..." id="montop" name="montop" value="0">
                                                        
                         </div>
                      
                      </div>

                  </div>


                  <div class="row">
                      
                      <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">
                      
                          <div class="form-group">
                          
                            <button type="submit" class="btn btn-success">Registrar </button>

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

<!-- FIN Modal-->	


<!-- HISTORIAL PAGOS -->	

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Comprobantes de Pagos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      
      <div class="modal-body">

      </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- FIN Modal-->	

@endsection


@push ('scripts')
  
<script>

    function ingresarPagos(){

      $("table tbody tr").click(function() {
          var text = '';
          var filaid= $(this).find("td:eq(0)").text();
          var cotizacion= $(this).find("td:eq(1)").text();
          var varDolar= $(this).find("td:eq(2)").text();
          var varPesos= $(this).find("td:eq(3)").text();

          var montod = parseFloat(varDolar);

          var montop = parseFloat(varPesos);

          var fcotizacion = parseFloat(cotizacion);

          var totald = redondear(montod * fcotizacion);
            
          var totalg = (montod * fcotizacion) + montop;

          var totalRound = redondear(totald);

          $("#pagos_id").val(filaid);
          $("#totald").val(varDolar);
          $("#totalp").val(varPesos);
          $("#total").val(totalg);

          var resultado = "*AR$"+totalRound+"  T.C:AR$"+cotizacion;
          document.getElementById("label1").innerHTML = resultado;
      });
    }

    function redondear($valor){
			$float_redondeado = Math.round($valor * 100) /100;
			return $float_redondeado;
		}
	

    function calcularVuelto()
    {			
      var monto = document.getElementById("monto").value;

      var cotizacion = document.getElementById("cotizacion").value;

      var vuelto = monto / cotizacion;

      //$("#montoDolares").val(vuelto);

      $("#montoDolares").val(redondear(vuelto));

      var resultado = "*U$D " + redondear(vuelto);
      
      document.getElementById("label2").innerHTML = resultado;
      
    }

    </script>
    
@endpush
