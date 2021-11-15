@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
            
        <div class="container-fluid">
              
          <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1>Estadisticas Productos General</h1>
              
              </div>

          </div>
        
        </div>
      
      </section>
      
        <div class="row">
        
          <div class="col-12">

          <div class="container-fluid">

            <div class="row mb-2">
              
              <div class="col-sm-6">

                <p style="font-size: 15px;font-family: Arial;padding-left: 10px;"> Total de Productos Registrados : <strong> {{$totalProductos}} </strong></p>
              
              </div>

            </div>

          </div>
              
                <div class="card-body table-responsive p-0">

                      <table class="table table-hover text-nowrap" id="ejemplo" border="1">
                        
                        <thead>
                          <tr>
                              <th colspan="4" style="text-align:center;background:blue;color:white">Top Productos con mas Ventas</th>
                          </tr>
                          <tr>
                              <th style="text-align:center;">Nombre</th>
                              <th style="text-align:center;">N° de Ventas</th>
                              <th style="text-align:center;">Total $</th>
                              <th style="text-align:center;">Ticket Promedio</th>
                          </tr>

                        </thead>
                        
                        <tbody>
                          @foreach ($productosMasVendidos as $producto)
                          <tr>
                              <td style="text-align:center;"><a href="{{ route('estadisticas.producto',$producto->id)}}">{{ $producto->nombre }}</a></td>
                              <td style="text-align:center;">{{ $producto->total }}  </td>
                              <td style="text-align:center;">AR$ {{ number_format( $producto->suma, 2 , ',' , '.')}}</td>
                              <td style="text-align:center;">AR$  {{ number_format( $producto->suma / $producto->total, 2 , ',' , '.') }}</td>

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

                <br>

                <div class="card-body table-responsive p-0">

                  <table class="table table-hover text-nowrap" id="ejemplo" border="1">
                    
                    <thead>
                      <tr>
                          <th colspan="4" style="text-align:center;background:blue;color:white">Cantidad de Productos Mas Vendidos</th>
                      </tr>
                      <tr>
                          <th style="text-align:center;">Nombre</th>
                          <th style="text-align:center;">Cantidad</th>
                          <th style="text-align:center;">Total $</th>
                          <th style="text-align:center;">Ticket Promedio</th>
                      </tr>

                    </thead>
                    
                    <tbody>
                      @foreach ($cantidadProductosMasVendidos as $producto)
                      <tr>
                          <td style="text-align:center;"><a href="{{ route('estadisticas.producto',$producto->id)}}">{{ $producto->nombre }}</a></td>
                          <td style="text-align:center;">{{ $producto->cantidad }}  </td>
                          <td style="text-align:center;">AR$ {{ number_format( $producto->suma, 2 , ',' , '.')}}</td>
                          <td style="text-align:center;">AR$  {{ number_format( $producto->suma / $producto->total, 2 , ',' , '.') }}</td>

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

@endsection
