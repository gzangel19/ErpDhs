@extends('layouts.app')
@section('content')

<div class="container">

  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
        
        <div class="container-fluid">
          
          <div class="row mb-2">
                

          </div>

        </div>

      </section>

        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                  <h1> Ventas Diaria</h1>
                
                  <div class="card-tools">

                
                  </div>

                  <h5> Dia: {{$dia}}  </h5>
                  <h5> Vendedor: {{$vendedor->apellido}} , {{$vendedor->nombre}}  </h5>
                  <h5> Total Ventas: AR$ {{$total->totalPesos}}  </h5>
                  <h5> Total Dolares: U$D {{$total->totalDolares}} </h5>

              </div>

                <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                  
                  <table class="table table-hover text-nowrap">
                    
                      <thead>
                        
                        <tr>
                            <th style="text-align:center;">Nº</th>  
                            <th style="text-align:center;">Total</th>  
                            <th style="text-align:center;">Forma de Pago</th>
                            <th style="text-align:center;">Estado</th>                                    
                        </tr>

                      </thead>

                      <tbody>
                        @foreach ($ventas as $venta)
                        <tr>
                            <td style="text-align:center;"> {{ $venta->num_pedido }}</td>
                            <td style="text-align:center;"> AR$ {{ $venta->total }}</td>
                            <td style="text-align:center;"> {{ $venta->modo_venta }}</td>
                            <td style="text-align:center;"> {{ $venta->estado }}</td>
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


@endsection
