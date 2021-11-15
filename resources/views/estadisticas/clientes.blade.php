@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
            
        <div class="container-fluid">
              
          <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1>Estadisticas Clientes General</h1>
              
              </div>

          </div>
        
        </div>
      
      </section>
      
        <div class="row">
        
          <div class="col-12">
              
                <div class="card-body table-responsive p-0">

                    <table class="table table-hover text-nowrap">
                        
                        <thead>
                          <tr>
                              <th style="text-align:center;">Razon Social</th>
                              <th style="text-align:center;">N° de Ventas</th>
                              <th style="text-align:center;">Total $</th>
                              <th style="text-align:center;">Ticket Promedio</th>
                          </tr>

                        </thead>
                        
                        <tbody>
                          @foreach ($totalVentas as $cliente)
                          <tr>
                              <td style="text-align:center;"><a href="{{ route('estadisticas.cliente',$cliente->id)}}">{{ $cliente->razon_Social }}</a></td>
                              <td style="text-align:center;">{{ $cliente->total }}  </td>
                              <td style="text-align:center;">AR$  {{ number_format( $cliente->suma, 2 , ',' , '.')}}</td>
                              <td style="text-align:center;">AR$  {{ number_format( $cliente->suma / $cliente->total, 2 , ',' , '.') }}</td>
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
                    
                </div>

          </div>

        </div>

    </div>

  </div>

</div>

@endsection
