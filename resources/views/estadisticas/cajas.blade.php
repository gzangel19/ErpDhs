@extends('layouts.app')
@section('content')

<div class="container">

  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
        
        <div class="container-fluid">
          
          <div class="row mb-2">

          <h2> Estadisticas Generales de las Cajas  desde el <?php echo date("d/m/Y", strtotime($searchText)) ?> al  <?php echo date("d/m/Y", strtotime($ultimo)) ?></h2>
                
          </div>

        </div>

      </section>

      <div class="row">
        
        <div class="col-12">
            
              <div class="card-body table-responsive p-0">

                  <table class="table table-hover text-nowrap">
                      
                      <thead>
                        <tr>
                            <th style="text-align:center;"> Nombre </th>
                            <th style="text-align:center;"> Entradas </th>
                            <th style="text-align:center;"> Salidas </th>
                            <th style="text-align:center;"> Dolares </th>
                        </tr>

                      </thead>
                      
                      <tbody>
                        @foreach ($cajas as $caja)
                        <tr>
                            <td style="text-align:center;"><a href="{{ route('estadisticas.caja',[$caja->id,$searchText,$ultimo])}}">{{ $caja->nombre }}</a></td>
                            <td style="text-align:center;"> AR$ {{ $caja->entrada }}  </td>
                            <td style="text-align:center;"> AR$ {{ $caja->salida }}  </td>
                            <td style="text-align:center;"> U$D {{ $caja->dolares }}  </td>
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
