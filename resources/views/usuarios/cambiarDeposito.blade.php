@extends('layouts.app')
@section('content')

<div class="container">

  <div class="row justify-content-center">
    
    <div class="col-md-12">

      <section class="content-header">
        
        <div class="container-fluid">
          
          <div class="row mb-2">
                
            <div class="col-sm-6">

              <h1> Cambiar Deposito </h1> 

            </div>

          </div>

        </div>

      </section>

        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                  <h3 class="card-title"> Seleccione un Depositos</h3>
                
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
                            <th style="text-align:center;"> # </th>
                            <th> Nombre </th>
                            <th> Direccion </th>
                            <th> Opciones </th>                                     
                        </tr>

                      </thead>

                      <tbody>
                        @foreach ($cajas as $caja)
                        <tr>
                            <td style="text-align:center;">{{ $loop->iteration }}</td>
                            <td> {{ $caja->deposito->nombre }}</td>
                            <td> {{ $caja->deposito->direccion }} , {{ $caja->deposito->ciudad }} , {{ $caja->deposito->provincia->nombre }} </td>
                            <td>
                              <a href="{{ route('usuarios.updateDeposito', $caja->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Seleccionar Deposito" data-original-title="Seleccionar Deposito"> Seleccionar </a>
                            </td>
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
