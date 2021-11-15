@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
            
        <div class="container-fluid">
              
          <div class="row mb-12">
              
              <div class="col-sm-12">
                
                <h1>Estadisticas de {{$producto->nombre}} al <?php   $fechaActual = date('d/m/Y'); echo $fechaActual; ?></h1>
              
              </div>

          </div>
        
        </div>
      
      </section>
      
        <div class="row">

          <div class="col-12">
            
            <div class="container-fluid">

              <div class="row mb-2">
                
                <div class="col-sm-6">

                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Total de Ventas : <strong> {{$totalVentas->total}} </strong></p>

                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Total $ en Ventas : <strong> AR$ {{ number_format( $totalVentas->suma, 2 , ',' , '.')    }}  </strong> </p>

                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Ticket Promedio : <strong> AR$ {{ number_format( $totalVentas->suma / $totalVentas->total, 2 , ',' , '.') }}  </strong></p>

                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Dolares Ingresados : <strong> U$D {{ number_format( $totalVentas->dolares, 2 , ',' , '.')    }}  </strong> </p>
                  
                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Cantidad de unidades Vendidas : <strong> {{ $totalVentas->cantidad }}  </strong> </p>
                
                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Ultima Compra : <strong> {{ $ultimoPedido->getFromDateAttribute($ultimoPedido->created_at)}} </strong> 
                  
                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Dias Desde la Ultima Compra :  <strong>{{ $ultimoPedido->calcular($ultimoPedido->created_at,$ultimoPedido->id)}} </strong></p>

                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Ultimo Cliente Comprado :  <strong>{{ $ultimoPedido->razon_Social }} </strong></p>

                </div>
              
              </div>

              <div class="card-body table-responsive p-0">

                <table class="table table-hover text-nowrap" border="1">
                  
                  <thead>
                    <tr>
                        <th colspan="2" style="text-align:center;background:blue;color:white">Stock en Cada Deposito</th>
                    </tr>
                    <tr>
                        <th style="text-align:center;">Deposito</th>
                        <th style="text-align:center;">Stock</th>
                    </tr>

                  </thead>
                  
                  <tbody>
                    @foreach ($stocks as $producto)
                    <tr>
                        <td style="text-align:center;">{{ $producto->deposito }}</td>
                        <td style="text-align:center;">{{ $producto->stock }}  </td>
                    </tr>
                    @endforeach
                  
                  </tbody>

                  <tfoot>

                    <tr>
                        <th></th>
                        <th></th>
                    </tr>

                  </tfoot>

                </table>

                <br>

                <table class="table table-hover text-nowrap" border="1">
                  
                  <thead>
                    <tr>
                        <th colspan="4" style="text-align:center;background:blue;color:white">Clientes que han comprado el producto</th>
                    </tr>
                    <tr>
                        <th style="text-align:center;">Cliente</th>
                        <th style="text-align:center;">Cantidad</th>
                        <th style="text-align:center;">Total</th>
                        <th style="text-align:center;">Ticket Primedio</th>
                    </tr>

                  </thead>
                  
                  <tbody>
                    @foreach ($detalleVentas as $producto)
                    <tr>
                        <td style="text-align:center;">{{ $producto->razon_Social }}</td>
                        <td style="text-align:center;">{{ $producto->cantidad }}  </td>
                        <td style="text-align:center;"> AR$ {{ number_format( $producto->suma, 2 , ',' , '.')}}</td>
                        <td style="text-align:center;"> AR$  {{ number_format( $producto->suma / $producto->cantidad, 2 , ',' , '.') }}</td>

                    </tr>
                    @endforeach
                  
                  </tbody>

                  <tfoot>

                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                  </tfoot>

                </table>

                </div>

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

$(document).ready(function()
{

    var total_col2 = 0;

    $('#ejemplo tbody').find('tr').each(function (i, el) {
                 
          total_col2 += parseFloat($(this).find('td').eq(1).text());
                  
      });

      $('#ejemplo tfoot tr th').eq(1).text(total_col2);

  });

</script>

@endpush

