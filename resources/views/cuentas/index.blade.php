@extends('layouts.app')
@section('content')

<div class="container">

  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
        
        <div class="container-fluid">
          
          <div class="row mb-2">
                
            <div class="col-sm-6">

              <h1>Cuentas Corrientes</h1> 

            </div>

          </div>

        </div>

      </section>

        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                  <h3 class="card-title">Listado de Clientes con Cuenta Corriente</h3>
                
                  <div class="card-tools">
                        
                      <div class="input-group input-group-sm" style="width: 250px;">
                        
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                        <div class="input-group-append">

                          <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                        
                        </div>

                      </div>

                  </div>

              </div>

                <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                  
                  <table class="table table-hover text-nowrap">
                    
                      <thead>
                        
                        <tr>
                            <th style="text-align:center;"> Nombre </th>
                            <th style="text-align:center;"> Credito Asignado U$D </th>
                            <th style="text-align:center;"> Credito Asignado AR$ </th>
                            <th style="text-align:center;"> Historial </th>                                       
                        </tr>

                      </thead>

                      <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td style="text-align:center;">{{ $cliente->razon_Social }}</td>
                            <td style="text-align:center;"> U$D {{ $cliente->montoCuenta}}</td>
                            <td style="text-align:center;"> AR$ {{ $cliente->montoCuentaPesos}}</td>
                            <td style="text-align:center;"> <a href="{{ route('cuentas.historialClienteCorriente',$cliente->id)}}" class="btn btn-link"  title="Historial de Pagos" data-original-title="Historial de Pagos"><i class="fas fa-address-card" style="font-size: 20px;"></i></a></td>
                          </tr>
                        @endforeach
                      </tbody>

                  </table>
                  {{ $clientes->render() }}</td>
              </div>
               
            </div>
             
          </div>

        </div>

    </div>

  </div>

</div>
@endsection
