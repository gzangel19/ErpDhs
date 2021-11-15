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
                
                  <h1> Ventas Por Mes</h1>
                
                  <div class="card-tools">

                  </div>

                  <h5> Vendedor: {{$vendedor->apellido}} , {{$vendedor->nombre}}  </h5>

              </div>

                <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                  
                  <table class="table table-hover text-nowrap">
                    
                      <thead>
                        
                        <tr>
                            <th style="text-align:center;">Mes</th> 
                            <th style="text-align:center;">Total</th> 
                            <th style="text-align:center;">Dolares</th>                                     
                        </tr>

                      </thead>

                      <tbody>
                        @foreach ($ventas as $venta)
                        <tr>
                            @if($venta->mes < 10)
                            <td style="text-align:center;"> 0{{ $venta->mes }}/{{ $venta->anio }}</td>
                            @else
                            <td style="text-align:center;"> {{ $venta->mes }}/{{ $venta->anio }}</td>
                            @endif
                            <td style="text-align:center;"> AR$ {{ $venta->totalPesos }}</td>
                            <td style="text-align:center;"> U$D {{ $venta->totalDolares }}</td>
                          </tr>
                        @endforeach
                      </tbody>

                  </table>

              </div>

              <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">

                  <canvas id="myChart" width="400" height="400"></canvas>
              
              </div>
            
            </div>
             
          </div>

        </div>

    </div>

  </div>

</div>


@endsection

@push ('scripts')
  
  <script src = "https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"> </script>

  <script>
     
      var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: [ <?php foreach($ventas as $t):?>
                        <?php echo $t->mes;?>, 
                        <?php endforeach; ?>],
              datasets: [{
                  label: "Ingresos Mensuales",
                  data: [ <?php foreach($total as $t):?>
                        <?php echo $t->totalPesos;?>, 
                        <?php endforeach; ?>],
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)',
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(75, 192, 192, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)',
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });
  
  </script>

@endpush
