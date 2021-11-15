@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
            
        <div class="container-fluid">
              
          <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1>Estadisticas de {{$cliente->razon_Social}} al <?php   $fechaActual = date('d/m/Y'); echo $fechaActual; ?></h1>
              
              </div>

          </div>
        
        </div>
      
      </section>
      
        <div class="row">

          <div class="col-12">
            
            <div class="container-fluid">

              <div class="row mb-2">
                
                <div class="col-sm-6">

                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Total de Compras : <strong> {{$totalVentas->total}} </strong></p>
              
                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Total Gastado : <strong> AR$ {{ number_format( $totalVentas->suma, 2 , ',' , '.')    }}  </strong> </p>

                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Ticket Promedio : <strong> AR$ {{ number_format( $totalVentas->suma / $totalVentas->total, 2 , ',' , '.') }}  </strong></p>
                
                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Ultima Compra : <strong> {{ $ultimoPedido->getFromDateAttribute($ultimoPedido->created_at)}} </strong> 
                  
                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Dias Desde la Ultima Compra :  <strong>{{ $ultimoPedido->calcular($ultimoPedido->created_at,$ultimoPedido->id)}} </strong></p>

                  <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Vendedor: <strong> {{ $ultimoPedido->user->nombre}} </strong> </p>
                </div>
              
              </div>

            </div>
            
            <table class="table table-hover text-nowrap" id="ejemplo" border="1">
                        
                        <thead>
                          <tr>
                              <th colspan="2" style="text-align:center;background:blue;color:white">Productos Comprados</th>
                          </tr>
                          <tr>
                              <th style="text-align:center;">Produco</th>
                              <th style="text-align:center;">Cantidad</th>
                          </tr>

                        </thead>
                        
                        <tbody>
                          @foreach ($productosComprados as $producto)
                          <tr>
                              <td style="text-align:center;">{{ $producto->nombre }}</td>
                              <td style="text-align:center;">{{ $producto->total }}  </td>
                          </tr>
                          @endforeach
                        
                        </tbody>

                        <tfoot>

                          <tr>
                              <th style="text-align:center;">Total</th>
                              <th style="text-align:center;"></th>
                          </tr>

                        </tfoot>
                    
                    </table>

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

