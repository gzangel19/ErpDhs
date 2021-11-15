@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-12">

                <h1> Detalle Comision General  desde el <?php echo date("d/m/Y", strtotime($searchText)) ?> al  <?php echo date("d/m/Y", strtotime($ultimo)) ?></h1>

              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                  <div class="card-tools">

                    <form class="form-inline" action="{{ route('comisiones.global') }}" role="form">
                    
                        <div class="input-group input-group-sm" style="width: 500px;">  
                          
                          <input type="date" name="searchText" class="form-control float-right" placeholder="Buscar" id="searchTerm">

                          <input type="date" name="searchTextHasta" class="form-control float-right" placeholder="Buscar" id="searchTerm">

                          <div class="input-group-append">
                            
                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                          
                          </div>

                        </div>

                    </form>


                  </div>
                  

              </div>



              <div class="card-body table-responsive p-0">
                      
                      <table class="table table-hover text-nowrap">
                        
                        <thead>
                            
                            <tr style="text-align:center">

                                <th> Vendedor </th>
                                <th> Cantidad de Ventas </th>                                
                                <th> Cantidad de Bonus </th>
                                <th> Valor Bonus </th>
                                <th> Total Comisiones </th>
                            </tr>
                        
                        </thead>

                        <tfoot>

                            <tr style="text-align:center">
                                <th> Vendedor </th>
                                <th> Cantidad de Ventas </th> 
                                <th> Cantidad de Bonus </th>
                                <th> Valor Bonus </th>
                                <th> Total Comisiones </th>
                            </tr>

                        </tfoot>

                        <tbody>
                          
                          @foreach ($ventas as $venta)
                            
                            <tr style="text-align:center">
                                <td> {{ $venta->apellido }} , {{ $venta->nombre}}</td>
                                <td> {{ $venta->suma }} </td>
                                <td> {{ floor ( ( ( $venta->totalPesos * ($venta->porcentaje/100) )  / $venta->bonus ) ) }}  </td> 
                                <td> AR$ {{ number_format( (floor ( ( ( $venta->totalPesos * ($venta->porcentaje/100) )  / $venta->bonus ) )) * $venta->valorBonus, 2 , ',' , '.') }}  </td>
                                <td> AR$ {{ number_format( ( (floor ( ( ( $venta->totalPesos * ($venta->porcentaje/100) )  / $venta->bonus ) )) * $venta->valorBonus ) + ( $venta->totalPesos * ($venta->porcentaje/100) ), 2 , ',' , '.')  }}  </td>
                            </tr>
                          @endforeach

                        </tbody>
                  
                      </table>
                    
                      <div class="form-group mtop16">           
                          
                        <a class="btn btn-success" href="{{ route('reporte.comisiones', [ $searchText, $ultimo ] ) }}" role="button"> Imprimir </a>
                    
                      </div>

                </div>

              <div>
        
            </div>

          </div>

        </div>

    </div>

</div>

</div>
</div>
</div>
@endsection
