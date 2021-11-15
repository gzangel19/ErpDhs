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
                
                  <h1> Productos Sin Stock</h1>
                
                  <div class="card-tools">

                        <form class="form-inline" action="{{ route('estadisticas.productosSinStock')}}" role="form">
                          
                          <div class="input-group input-group-sm" style="width: 300px;">          
                            
                              <select class="form-control" name="searchCondicion">
                                        
                                        @foreach ($unidades as $unidad)
                                          <option value="{{ $unidad->id}}">{{ $unidad->nombre}}</option>                    
                                        @endforeach
                                      
                              </select>
                                                 
                              <div class="input-group-append">
                                  
                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                              
                              </div>

                          </div>
                        
                        </form>
                      
                  </div>

              </div>

                <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                  
                  <table class="table table-hover text-nowrap">
                    
                      <thead>
                        
                        <tr>
                            <th style="text-align:center;">Nombre</th>
                            <th style="text-align:center;">Stock</th>
                            <th style="text-align:center;">Unidad de Negocio</th>  
                            <th style="text-align:center;">Deposito</th>                                   
                        </tr>

                      </thead>

                      <tbody>
                        @foreach ($productos as $producto)
                        <tr>
                            <td style="text-align:center;">{{ $producto->nombre }}</td>
                            <td style="text-align:center;">{{ $producto->stock }}</td>
                            <td style="text-align:center;">{{ $producto->unidad }}</td>
                            <td style="text-align:center;">{{ $producto->deposito }}</td>
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
