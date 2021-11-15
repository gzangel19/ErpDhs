@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="row justify-content-center">
      
      <div class="col-md-12">

        <section class="content-header">
          
          <div class="container-fluid">
            
            <div class="row mb-2">
              
              <div class="col-sm-6">
                
                <h1>Pedidos</h1>
              
              </div>

            </div>
          
          </div>
        
        </section>
        
        <div class="row">
          
          <div class="col-12">
            
            <div class="card">
              
              <div class="card-header">
                
                <h3 class="card-title">Seleccione Unidad de Negocio</h3>

                  <div class="card-tools">
                    
                    <div class="input-group input-group-sm" style="width: 250px;">  
                      
                      <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar" id="searchTerm"  onkeyup="doSearch()">

                      <div class="input-group-append">
                        
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                      
                      </div>

                    </div>

                  </div>

              </div>

              <div class="card-body table-responsive p-0">
                
                <table class="table table-hover text-nowrap" id="datos">
                  
                  <thead>
                    
                    <tr>                    
                      <th style="text-align:center;"><a href="{{ route('clientes.create') }}" class="btn btn-link" data-toggle="tooltip" title="Generar Presupuesto" data-original-title="Generar Presupuesto"><i class="fas fa-plus"></i></a></th>
                      <th>Nombre</th>
                      <th>Seleccione</th>
                    </tr>
                  
                  </thead>
                  
                  <tbody>
                      @foreach ($unidades as $unidad)
                      
                    <tr>
                        <td style="text-align:center;">{{$loop->iteration}}</td>
                        <td>{{ $unidad->nombre }}</td>
                        <td><a href="{{ route('pedidos.create',['cliente' => $cliente, 'unidad' => $unidad->id]) }}"  class="btn btn-success" data-toggle="tooltip" title="Seleccionar" data-original-title="Seleccionar"><i class="fas fa-check"></i></a></td>
                    </tr>
                      
                      @endforeach
                  </tbody>

                  <tfoot>

                    <tr>
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

</div>
@endsection
