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
                
                  <h1> Caja Diaria</h1>
                
                  <div class="card-tools">

                  

                  </div>

                  <h5> Dia: {{$dia}}  </h5>
                  <h5> Ingreso: AR$ {{$total->entrada}}  </h5>
                  <h5> Egresos: AR$ {{$total->salida}}  </h5>

              </div>

                <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                  
                  <table class="table table-hover text-nowrap">
                    
                      <thead>
                        
                        <tr>
                            <th style="text-align:center;">Dia</th>
                            <th style="text-align:center;">Descripcion</th>  
                            <th style="text-align:center;">Entrada</th>  
                            <th style="text-align:center;">Salida</th>                                    
                        </tr>

                      </thead>

                      <tbody>
                        @foreach ($movimientos as $movimiento)
                        <tr>
                            <td style="text-align:center;"> {{ $movimiento->getFromDay($movimiento->fecha) }}</td>
                            <td style="text-align:center;">AR$ {{ $movimiento->descripcion }}</td>
                            <td style="text-align:center;">AR$ {{ $movimiento->entrada }}</td>
                            <td style="text-align:center;">AR$ {{ $movimiento->salida }}</td>
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
